<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    use Signaturgruppen\SPS\Api\Body;

    class IdentityQueryRequest extends Body
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
         * @var SignerIdentity|null
         */
        public $Identity;

        /**
         * @var bool|null
         */
        public $ExcludeAlreadySigned;

    };
}

