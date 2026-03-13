<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoneyFusionService
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.moneyfusion.api_url');
    }

    public function createPayment(array $data): array
    {
        $response = Http::post($this->apiUrl, $data);

        return $response->json();
    }

    public function checkPayment(string $token): array
    {
        $url = config('services.moneyfusion.check_url') . '/' . $token;

        $response = Http::get($url);

        return $response->json();
    }
}