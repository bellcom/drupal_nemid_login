<?php

namespace Signaturgruppen\SPS\Api\Services\NemID {

    use Signaturgruppen\SPS\Api\Body;

    class MatchPidCprResponse extends Body
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
         * @var bool|null
         */
        public $Match;

    };
}

