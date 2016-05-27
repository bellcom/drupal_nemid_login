<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Frame;


use Signaturgruppen\SPS\Api\Frame\FlowConfig;
use Signaturgruppen\SPS\Configuration\Config;
use Signaturgruppen\SPS\Transport\FlowMessageWrapper;

class FrameBuilder
{
    /**
     * @var FlowConfig
     */
    protected $flowConfig;

    /**
     * FrameBuilder constructor.
     * @param FlowConfig $flowConfig
     */
    public function __construct(FlowConfig $flowConfig)
    {
        $this->flowConfig = $flowConfig;
    }

    public function buildScript($returnUrl)
    {
        $config = Config::getDefault();

        $message = $this->getMessage($config);
        $script = new Script($message->Content, $returnUrl, $config->backendUrl);
        return $script->asHtml();
    }

    /**
     * @param Config $config
     * @return \Signaturgruppen\SPS\Transport\Message
     */
    private function getMessage($config)
    {
        $wrapper = new FlowMessageWrapper($config->getCredentials(), $config->getBackendCertificate());
        $transactionId = Session::createTransactionId();
        return $wrapper->wrap($this->flowConfig, $config->getClientIdentifier(), $transactionId);
    }

}