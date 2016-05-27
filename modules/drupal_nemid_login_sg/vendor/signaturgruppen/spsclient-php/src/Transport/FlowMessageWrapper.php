<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;


use Signaturgruppen\SPS\Api\Frame\FlowMessage;
use Signaturgruppen\SPS\Crypto\Certificate;

class FlowMessageWrapper
{
    /**
     * @var Certificate
     */
    private $sender;

    /**
     * @var Certificate
     */
    private $recipient;

    /**
     * FlowMessageWrapper constructor.
     * @param Certificate $sender
     * @param Certificate $recipient
     */
    public function __construct(Certificate $sender, Certificate $recipient)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    /**
     * @param FlowMessage $message
     * @param $clientId
     * @param $transactionId
     * @return Message
     */
    public function wrap(FlowMessage $message, $clientId, $transactionId)
    {
        $envelope = Envelope::forBody($message);
        $envelope->ClientIdentifier = $clientId;
        $envelope->TransactionIdentifier = $transactionId;

        $handler = new SecurityHandler($this->sender, $this->recipient);
        $handler->wrap($envelope);
        return $envelope->serialize();
    }

    /**
     * @param Message $message
     * @return FlowMessage
     */
    public function unwrap(Message $message)
    {
        $envelope = Envelope::fromMessage($message);
        $handler = new SecurityHandler($this->sender, $this->recipient);
        $handler->unwrap($envelope);
        $flowMessage = $this->getFlowMessage($envelope);
        $flowMessage->TransactionIdentifier = $envelope->TransactionIdentifier;
        $flowMessage->Timestamp = $envelope->Timestamp;
        return $flowMessage;
    }

    /**
     * @param Envelope $envelope
     * @return \Signaturgruppen\SPS\Api\Frame\FlowMessage
     */
    private function getFlowMessage(Envelope $envelope)
    {
        return $envelope->getBody();
    }
}