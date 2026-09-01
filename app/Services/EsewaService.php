<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EsewaService
{
    protected string $merchantCode;
    protected string $secretKey;
    protected string $successUrl;
    protected string $failureUrl;
    protected string $formUrl;
    protected string $statusUrl;

    public function __construct()
    {
        $this->merchantCode = env('ESEWA_MERCHANT_CODE', 'EPAYTEST');
        $this->secretKey = env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q');
        $this->successUrl = env('ESEWA_SUCCESS_URL');
        $this->failureUrl = env('ESEWA_FAILURE_URL');
        $this->formUrl = 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';
        $this->statusUrl = 'https://rc.esewa.com.np/api/epay/transaction/status/';
    }

    protected function money(float $amount): string
    {
        return number_format($amount, 2, '.', '');
    }

    public function generateSignature(string $totalAmount, string $transactionUuid, string $productCode): string
    {
        $data = "total_amount={$totalAmount},transaction_uuid={$transactionUuid},product_code={$productCode}";
        return base64_encode(hash_hmac('sha256', $data, $this->secretKey, true));
    }

    public function initiatePayment($order): array
    {
        $amount = $this->money((float) $order->subtotal);
        $taxAmount = $this->money(0);
        $serviceCharge = $this->money(0);
        $deliveryCharge = $this->money((float) $order->delivery_charge);
        $totalAmount = $this->money((float) $amount + (float) $taxAmount + (float) $serviceCharge + (float) $deliveryCharge);

        $transactionUuid = $order->id . '-' . uniqid();

        $signature = $this->generateSignature($totalAmount, $transactionUuid, $this->merchantCode);

        $order->update(['payment_reference' => $transactionUuid]);

        return [
            'url' => $this->formUrl,
            'params' => [
                'amount' => $amount,
                'tax_amount' => $taxAmount,
                'product_service_charge' => $serviceCharge,
                'product_delivery_charge' => $deliveryCharge,
                'total_amount' => $totalAmount,
                'transaction_uuid' => $transactionUuid,
                'product_code' => $this->merchantCode,
                'success_url' => $this->successUrl,
                'failure_url' => $this->failureUrl,
                'signed_field_names' => 'total_amount,transaction_uuid,product_code',
                'signature' => $signature,
            ],
        ];
    }

    public function verifyPayment(string $totalAmount, string $transactionUuid): array
    {
        try {
            $response = Http::timeout(30)->withoutVerifying()->get($this->statusUrl, [
                'product_code' => $this->merchantCode,
                'total_amount' => $totalAmount,
                'transaction_uuid' => $transactionUuid,
            ]);

            $data = $response->json();
            Log::info('eSewa status check', ['response' => $data]);

            if (($data['status'] ?? null) === 'COMPLETE') {
                return ['success' => true, 'data' => $data];
            }

            return ['success' => false, 'message' => $data['status'] ?? 'Unknown status', 'data' => $data];
        } catch (\Exception $e) {
            Log::error('eSewa verification error: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
