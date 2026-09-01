<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\EsewaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EsewaController extends Controller
{
    public function __construct(protected EsewaService $esewaService)
    {
    }

    public function redirect(Request $request)
    {
        $paymentData = session('esewa_payment_data');

        if (!$paymentData) {
            return redirect()->route('checkout');
        }

        return view('esewa.redirect', compact('paymentData'));
    }

    public function success(Request $request)
    {
        $decoded = json_decode(base64_decode($request->query('data', '')), true);

        Log::info('eSewa success callback', ['decoded' => $decoded]);

        if (!$decoded || empty($decoded['transaction_uuid'])) {
            session()->flash('error', 'Invalid payment response from eSewa.');
            return redirect()->route('checkout');
        }

        $orderId = explode('-', $decoded['transaction_uuid'])[0];
        $order = Order::find($orderId);

        if (!$order) {
            session()->flash('error', 'Order not found.');
            return redirect()->route('checkout');
        }

        $verification = $this->esewaService->verifyPayment(
            $decoded['total_amount'],
            $decoded['transaction_uuid']
        );

        if ($verification['success']) {
            $order->update(['payment_status' => 'paid', 'status' => 'processing']);
            session()->flash('success', 'Payment successful! Your order has been placed.');
            return redirect()->route('orders.show', $order);
        }

        session()->flash('warning', 'Payment could not be verified yet. We will confirm it shortly.');
        return redirect()->route('orders.show', $order);
    }

    public function failure(Request $request)
    {
        Log::info('eSewa failure callback', ['request' => $request->all()]);
        session()->flash('error', 'Payment was cancelled or failed. You can try Cash on Delivery instead.');
        return redirect()->route('checkout');
    }
}
