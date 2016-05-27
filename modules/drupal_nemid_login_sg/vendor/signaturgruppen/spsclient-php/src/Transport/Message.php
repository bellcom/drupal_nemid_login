<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

class Message
{
    /**
     * @var string|null
     */
    public $Content;
    /**
     * @var string|null
     */
    public $Id;
    /**
     * @var string|null
     */
    public $ErrorMessage;
    /**
     * @var string|null
     */
    public $UserErrorMessage;
}