<?php

namespace App\Services\Twilio;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioSmsService
{
    /**
     * @var mixed
     */
    protected $twilio_number;

    /**
     * @var string
     */
    protected $baseMessage;

    public function __construct()
    {
        $this->twilio_number = env('TWILIO_FROM');
        $this->baseMessage = '2FA login code is';
    }

    /**
     * @throws ConfigurationException
     * @throws TwilioException
     */
    public function sendSmsTwoFactorCode(string $phone, string $code)
    {
        $clientTwilio = new ClientTwilio();
        $client = $clientTwilio->newClient();
        $client->messages->create($phone, [
            'from' => $this->twilio_number,
            'body' => "$this->baseMessage $code"
        ]);
    }
}
