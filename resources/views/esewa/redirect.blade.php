<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa...</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f9fafb;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #389436;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h2 {
            color: #1f2937;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }
        p {
            color: #6b7280;
            font-family: 'Inter', sans-serif;
        }
        .payment-details {
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: left;
        }
        .payment-details p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="loader"></div>
        <h2>Redirecting to eSewa...</h2>
        <p>Please wait while we redirect you to the payment gateway.</p>
        
        <div class="payment-details">
            <p><strong>Amount:</strong> NPR {{ number_format($paymentData['params']['total_amount'] ?? 0, 2) }}</p>
            <p><strong>Transaction ID:</strong> {{ $paymentData['params']['transaction_uuid'] ?? 'N/A' }}</p>
        </div>
        
        <form id="esewa-form" action="{{ $paymentData['url'] }}" method="POST">
            @foreach ($paymentData['params'] as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
        
        <p style="margin-top: 15px; font-size: 12px; color: #999;">
            You will be redirected automatically. If not, click the button below.
        </p>
        
        <button onclick="document.getElementById('esewa-form').submit()" 
                style="margin-top: 10px; padding: 10px 30px; background: #389436; color: white; border: none; border-radius: 30px; cursor: pointer; font-family: 'Inter', sans-serif; font-weight: 500;">
            Pay Now
        </button>
    </div>

    <script>
        // Auto-submit the form after 1.5 seconds
        setTimeout(function() {
            document.getElementById('esewa-form').submit();
        }, 1500);
    </script>
</body>
</html>
