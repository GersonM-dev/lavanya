<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected string $apiUrl = 'https://api.fonnte.com/send';
    protected string $token;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN', ''); // Set in .env
    }

    /**
     * Send WhatsApp message using Fonnte API.
     *
     * @param string $phone Target phone (with country code)
     * @param string $message The message to send
     * @param string $countryCode Country code (default '62')
     * @return array|bool API response or false on error
     */
    public function sendMessage(string $phone, string $message, string $countryCode = '62')
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->asForm()->post($this->apiUrl, [
                'target'      => $phone,
                'message'     => $message,
                'countryCode' => $countryCode,
            ]);

            return $response->json();
        } catch (\Exception $e) {
            \Log::error("WhatsApp API error: " . $e->getMessage());
            return false;
        }
    }
}
