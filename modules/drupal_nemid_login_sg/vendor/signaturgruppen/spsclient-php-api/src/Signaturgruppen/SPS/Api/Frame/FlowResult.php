<?php

namespace Signaturgruppen\SPS\Api\Frame {

    class FlowResult extends FlowMessage
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

        /**
         * @var string|null
         */
        public $Status;

        /**
         * @var bool|null
         */
        public $IsSuccess;

        /**
         * @var string|null
         */
        public $Message;

        /**
         * @var string|null
         */
        public $UserMessage;

    };
}

