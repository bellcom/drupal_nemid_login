<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Frame;


use Signaturgruppen\SPS\Api\Frame\NemID\NemIDFlowResult;
use Signaturgruppen\SPS\Configuration\Config;
use Signaturgruppen\SPS\Frame\Session;
use Signaturgruppen\SPS\Transport\FlowMessageWrapper;
use Signaturgruppen\SPS\Transport\Message;

class NemIDFlowValidator
{
    /**
     * Validate NemID response
     * @param $response
     * @return NemIDFlowResult
     * @throws \Exception
     */
    public function validate($response)
    {
        $config = Config::getDefault();
        $wrapper = new FlowMessageWrapper($config->getBackendCertificate(), $config->getCredentials());
        $message = new Message();
        $message->Content = $response;
        $result = $this->unwrap($wrapper, $message);
        $this->assertSuccess($result);
        $this->assertCorrectTransactionId($result);
        return $result;
    }

    /**
     * @param FlowMessageWrapper $wrapper
     * @param Message $message
     * @return NemIDFlowResult
     */
    private function unwrap($wrapper, $message)
    {
        $result = $wrapper->unwrap($message);
        return $result;
    }

    /**
     * @param $result
     * @throws \Exception
     */
    private function assertSuccess($result)
    {
        if (!$result->IsSuccess) {
            //throw new \Exception("Got error: " . $result->Status . " message: " . $result->Message . " UserMessage: " . $result->UserMessage);
        }
    }

    /**
     * @param $result
     * @throws \Exception
     */
    private function assertCorrectTransactionId($result)
    {
        $sessionTransId = Session::getTransactionId();
        if (strtolower($result->TransactionIdentifier) != strtolower($sessionTransId)) {
            throw new \Exception("Transaction identifiers does not match, got " . $result->TransactionIdentifier . " in flow result, found " . $sessionTransId . " in session");
        }
    }

}