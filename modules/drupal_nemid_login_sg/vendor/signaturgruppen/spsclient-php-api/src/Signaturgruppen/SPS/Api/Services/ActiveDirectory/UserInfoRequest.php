<?php

namespace Signaturgruppen\SPS\Api\Services\ActiveDirectory {

    use Signaturgruppen\SPS\Api\Body;

    class UserInfoRequest extends Body
    {
        public function mustEncrypt()
        {
            return false;
        }

        public function mustSign()
        {
            return true;
        }

        /**
         * @var string|null
         */
        public $Username;

    };
}

