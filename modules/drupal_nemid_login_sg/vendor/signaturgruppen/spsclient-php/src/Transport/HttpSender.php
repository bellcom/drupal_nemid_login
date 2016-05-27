<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

use Signaturgruppen\SPS\Api\Webservice;

class HttpSender
{
    private $backendUrl;
    private $service;

    /**
     * HttpSender constructor.
     * @param string $backendUrl
     * @param Webservice $service
     */
    public function __construct($backendUrl, $service)
    {
        $this->backendUrl = $backendUrl;
        $this->service = $service;
    }

    /**
     * @param Envelope $envelope
     * @param string $methodName
     * @return Envelope
     * @throws \Exception
     */
    public function send(Envelope $envelope, $methodName)
    {
        $url = $this->getUrl($methodName);
        $message = $envelope->serialize();

        $response = $this->sendMessage($url, $message);

        return Envelope::fromMessage($response);
    }

    private function getUrl($methodName)
    {
        return $this->backendUrl . "/api/v2/" . $this->service->getEndpoint() . "/" . $methodName;
    }

    /**
     * @param $url
     * @param $message
     * @return Message
     * @throws \Exception
     */
    public function sendMessage($url, $message)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json', 'Expect: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($curl_errno > 0) {
            $err = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Error communicating with SPS. Got curl error code: " . $curl_errno . " : " . $err);
        }
        curl_close($ch);
        if ($httpcode != 200) {
            throw new \Exception("Error communicating with SPS. Got status code " . $httpcode . ": " . $response);
        }
        return Mapper::deserialize($response, get_class($message));
    }
}