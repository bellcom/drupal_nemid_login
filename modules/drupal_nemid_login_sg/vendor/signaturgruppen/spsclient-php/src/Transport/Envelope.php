<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

use ReflectionClass;
use Signaturgruppen\SPS\Api\Body;
use Signaturgruppen\SPS\Crypto\UUID;

class Envelope
{
    /**
     * @param Message $message
     * @return Envelope
     */
    public static function fromMessage(Message $message)
    {
        $json = base64_decode($message->Content);
        return Mapper::deserialize($json, get_class(new Envelope()));
    }

    /**
     * @param Body $body
     * @return Envelope
     */
    public static function forBody(Body $body)
    {
        $envelope = new Envelope();
        $envelope->body = $body;
        $envelope->BodyTypeName = $envelope->getSuffixedBodyTypeName($body);
        return $envelope;
    }

    public function __construct()
    {
        $this->TransactionIdentifier = UUID::createNew();
        $this->Timestamp = $this->now();
    }

    /**
     * @var Body
     */
    private $body;

    /**
     * @var string
     */
    public $BodyTypeName;

    /**
     * @var string
     */
    public $BodySerialized;

    /**
     * @var string
     */
    public $ClientIdentifier;

    /**
     * @var string
     */
    public $TransactionIdentifier;

    /**
     * @var string
     */
    public $Timestamp;

    /**
     * @var string|null
     */
    public $EncryptedKey;

    /**
     * @var string|null
     */
    public $Signature;

    const API_PACKAGE_NAME = "Signaturgruppen\\SPS\\Api\\";

    private function getSuffixedBodyTypeName($body)
    {
        $canonical = get_class($body);
        $canonical = str_replace(self::API_PACKAGE_NAME, "", $canonical);
        $canonical = str_replace("\\", ".", $canonical);
        return $canonical;
    }

    private function getBodyClassName()
    {
        $canonical = self::API_PACKAGE_NAME . $this->BodyTypeName;
        return str_replace(".", "\\", $canonical);
    }

    /**
     * @return Body
     */
    private function newBodyObject()
    {
        $r = new ReflectionClass($this->getBodyClassName());
        return $r->newInstance();
    }

    public function serializeBody()
    {
        if ($this->body == null) {
            throw new \Exception("Body already serialized");
        }
        $this->BodySerialized = json_encode($this->body);
        $this->body = null;
    }

    public function deserializeBody()
    {
        if ($this->BodySerialized == null) {
            throw new \Exception("Body already deserialized");
        }

        $this->body = Mapper::deserialize($this->BodySerialized, $this->getBodyClassName());
    }

    /**
     * @return Body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function mustSign()
    {
        if ($this->body != null) {
            return $this->body->mustSign();
        }
        return $this->newBodyObject()->mustSign();
    }

    /**
     * @return bool
     */
    public function mustEncrypt()
    {
        if ($this->body != null) {
            return $this->body->mustEncrypt();
        }
        return $this->newBodyObject()->mustEncrypt();
    }

    public function isExpired()
    {
        if ($this->Timestamp == null) return true;
        return abs($this->now() - $this->Timestamp) > 180000;
    }

    /**
     * @return int
     */
    private function now()
    {
        return round(microtime(1) * 1000);
    }

    /**
     * @return Message
     */
    public function serialize()
    {
        $message = new Message();
        $message->Content = base64_encode(json_encode($this));
        return $message;
    }

}