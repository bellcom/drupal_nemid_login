<?php

namespace Signaturgruppen\SPS\Api\Frame {

    class FlowConfig extends FlowMessage
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
        public $ClientFlow;

    };
}

