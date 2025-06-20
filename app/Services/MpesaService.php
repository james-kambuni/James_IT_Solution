<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $shortcode;
    protected $passkey;
    protected $baseUrl;

    public function __construct()
    {
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->shortcode = env('MPESA_SHORTCODE', '174379'); // sandbox shortcode
        $this->passkey = env('MPESA_PASSKEY');
        $this->baseUrl = env('MPESA_BASE_URL', 'https://sandbox.safaricom.co.ke');
    }

    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get("{$this->baseUrl}/oauth/v1/generate?grant_type=client_credentials");

        return $response->json()['access_token'];
    }

    public function stkPush($phone, $amount, $orderId)
    {
        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);
        $callbackUrl = route('mpesa.callback');

        $payload = [
            "BusinessShortCode" => $this->shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $this->shortcode,
            "PhoneNumber" => $phone,
            "CallBackURL" => $callbackUrl,
            "AccountReference" => "Order #{$orderId}",
            "TransactionDesc" => "Payment for Order #{$orderId}"
        ];

        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/mpesa/stkpush/v1/processrequest", $payload);

        return $response->json();
    }
}
