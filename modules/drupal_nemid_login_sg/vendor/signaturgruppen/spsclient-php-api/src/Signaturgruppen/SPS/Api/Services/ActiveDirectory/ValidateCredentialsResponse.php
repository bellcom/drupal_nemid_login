<?php

namespace Signaturgruppen\SPS\Api\Services\ActiveDirectory {

    use Signaturgruppen\SPS\Api\Body;

    class ValidateCredentialsResponse extends Body
    {
        public function mustEncrypt()
        {
            return true;
        }

        public function mustSign()
        {
            return true;
        }

        /**
         * @var string|null
         */
        public $ValidationStatus;

        /**
         * @var Attribute[]
         */
        public $Attributes;

    };
}

