<?php

namespace App\Services\Twilio;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

class ClientTwilio
{
    /**
     * @var mixed
     */
    protected $account_sid;

    /**
     * @var mixed
     */
    protected $auth_token;

    /**
     * Construct ClientTwilio
     */
    public function __construct()
    {
        $this->account_sid = env('TWILIO_SID');
        $this->auth_token = env('TWILIO_TOKEN');
    }

    /**
     * @return Client
     * @throws ConfigurationException
     */
    public function newClient(): Client
    {
        return new Client($this->account_sid, $this->auth_token);
    }
}
