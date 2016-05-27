<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Api\Sample;

use Signaturgruppen\SPS\Api\Body;

class Request extends Body
{
    public $content;

    public function mustEncrypt()
    {
        return true;
    }

    public function mustSign()
    {
        return true;
    }
}