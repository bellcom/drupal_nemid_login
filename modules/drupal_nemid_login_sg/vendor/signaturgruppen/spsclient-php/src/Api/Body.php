<?php

namespace Signaturgruppen\SPS\Api;


abstract class Body
{
    public abstract function mustEncrypt();

    public abstract function mustSign();
}