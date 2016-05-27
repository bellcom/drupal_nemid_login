<?php

namespace Signaturgruppen\SPS\Api\Services\ActiveDirectory {

    use Signaturgruppen\SPS\Api\Body;

    class ValidateCredentialsRequest extends Body
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
        public $Username;

        /**
         * @var string|null
         */
        public $Password;

        /**
         * @var bool|null
         */
        public $IncludeInfo;

    };
}

