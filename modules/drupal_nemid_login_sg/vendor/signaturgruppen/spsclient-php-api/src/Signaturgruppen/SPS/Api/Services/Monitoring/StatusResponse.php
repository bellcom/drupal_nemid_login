<?php

namespace Signaturgruppen\SPS\Api\Services\Monitoring {

    use Signaturgruppen\SPS\Api\Body;

    class StatusResponse extends Body
    {
        public function mustEncrypt()
        {
            return false;
        }

        public function mustSign()
        {
            return false;
        }

        /**
         * @var string|null
         */
        public $EncryptedStatus;

    };
}

