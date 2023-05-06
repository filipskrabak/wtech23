@extends('layouts.main')

@section('title', 'Payment Options')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
            <h1 class="mt-5 mb-4 text-center">Payment Options</h1>
        </div>
    </div>
    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
        <p>We offer multiple payment methods for your convenience:</p>
        <ol>
            <li>
                <p>Cash on delivery: You can pay in cash to the delivery person when you receive your order. Please make sure you have the exact amount ready.</p>
            </li>
            <li>
                <p>Credit/Debit card: We accept all major credit and debit cards. Simply enter your card details during checkout and your payment will be processed securely.</p>
            </li>
            <li>
                <p>Paypal: You can also pay using your Paypal account. Simply choose Paypal as your payment method during checkout and you will be redirected to the Paypal website to complete your payment securely.</p>
            </li>
        </ol>
        <p>Generated by AI</p>
        </div>
    </div>
</div>

@endsection
