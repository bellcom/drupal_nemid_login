<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Frame;


class Script
{
    /**
     * @var string
     */
    private $messageContent;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var string
     */
    private $backendUrl;

    /**
     * Script constructor.
     * @param string $messageContent
     * @param string $returnUrl
     * @param string $backendUrl
     */
    public function __construct($messageContent, $returnUrl, $backendUrl)
    {
        $this->messageContent = $messageContent;
        $this->returnUrl = $returnUrl;
        $this->backendUrl = $backendUrl;
    }

    public function asHtml()
    {
        $string = "<script type=\"text/javascript\">";
        $string .= "function onMessage(event) {";
        $string .= " if (event.origin != '" . $this->getOrigin() . "') {";
        $string .= " return;";
        $string .= " }";
        $string .= "var message = JSON.parse(event.data);";
        $string .= "if (message.command === 'readyForParameters') {";
        $string .= " var htmlParameters = '" . $this->messageContent . "';";
        $string .= " var postMessage = {};";
        $string .= " postMessage.command = 'parameters';";
        $string .= " postMessage.content = htmlParameters;";
        $string .= " event.source.postMessage(JSON.stringify(postMessage), '" . $this->getOrigin() . "');";
        $string .= " }";
        $string .= "\n";
        $string .= "if (message.command === 'result') {";
        $string .= " var f = document.createElement('form');";
        $string .= " f.setAttribute('method', \"post\");";
        $string .= " f.setAttribute('action', \"" . $this->returnUrl . "\");";
        $string .= "\n";
        $string .= " var i = document.createElement(\"input\");";
        $string .= " i.setAttribute('type', \"hidden\");";
        $string .= " i.setAttribute('name', \"result\");";
        $string .= " i.setAttribute('value', message.content);";
        $string .= " f.appendChild(i);";
        $string .= " document.body.appendChild(f);";
        $string .= " f.submit();";
        $string .= " }";
        $string .= "}";
        $string .= "window.addEventListener('message', onMessage);";
        $string .= "</script>";
        return $string;
    }

    private function getOrigin()
    {
        return Origin::toOrigin($this->backendUrl);
    }


}