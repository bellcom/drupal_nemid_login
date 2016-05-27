<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;


use Signaturgruppen\SPS\Api\Body;
use Signaturgruppen\SPS\Api\Webservice;
use Signaturgruppen\SPS\Configuration\Config;
use Signaturgruppen\SPS\Crypto\Certificate;

class WebserviceClient
{
    private $sender;
    private $recipient;
    private $clientIdentifier;
    private $backendUrl;

    /**
     * Build client using loaded configuration.
     * @param Config $config
     * @return WebserviceClient
     */
    public static function fromConfig(Config $config)
    {
        $result = new WebserviceClient($config->getCredentials(), $config->getBackendCertificate(), $config->getClientIdentifier(), $config->getBackendUrl());
        return $result;
    }

    /**
     * WebserviceClient constructor.
     *
     * @param Certificate $sender
     * @param Certificate $recipient
     * @param string $clientIdentifier
     * @param string $backendUrl
     */
    public function __construct(Certificate $sender, Certificate $recipient, $clientIdentifier, $backendUrl)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->clientIdentifier = $clientIdentifier;
        $this->backendUrl = $backendUrl;
    }

    /**
     * Invoke webservice method.
     *
     * @param Body $request
     * @param Webservice $service
     * @param $methodName
     * @return Body
     */
    public function invoke(Body $request, Webservice $service, $methodName)
    {
        $envelope = Envelope::forBody($request);
        $envelope->ClientIdentifier = $this->clientIdentifier;
        $handler = new SecurityHandler($this->sender, $this->recipient);
        $handler->wrap($envelope);
        $httpSender = new HttpSender($this->backendUrl, $service);
        $response = $httpSender->send($envelope, $methodName);
        $other = new SecurityHandler($this->recipient, $this->sender);
        $other->unwrap($response);
        return $response->getBody();
    }

}