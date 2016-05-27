<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

use Doctrine\Common\Annotations\Annotation;

class ProtectionPolicy extends Annotation
{
    public $level;
}