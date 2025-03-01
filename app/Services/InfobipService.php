<?php

namespace App\Services;

use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class InfobipService
{
    protected $config;

    public function __construct()
    {
        $this->config = (new Configuration())
            ->setHost(config('services.infobip.base_url'))
            ->setApiKeyPrefix('Authorization', 'App')
            ->setApiKey('Authorization', config('services.infobip.api_key'));
    }

    public function sendSms($to, $message)
    {
        Log::info('Tentative d\'envoi de SMS à : ' . $to);
        Log::info('Message : ' . $message);
    
        $client = new Client([
            'verify' => env('SSL_CERT_PATH'), // Utilise la variable d'environnement
        ]);
    
        $sendSmsApi = new SendSmsApi($client, $this->config);
    
        $destination = (new SmsDestination())->setTo($to);
        $smsMessage = (new SmsTextualMessage())
            ->setFrom("E-ci")
            ->setText($message)
            ->setDestinations([$destination]);
    
        $smsRequest = (new SmsAdvancedTextualRequest())->setMessages([$smsMessage]);
    
        try {
            $response = $sendSmsApi->sendSmsMessage($smsRequest);
            Log::info('Réponse Infobip : ' . json_encode($response));
            return $response;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du SMS : ' . $e->getMessage());
            return false;
        }
    }
}