<?php

namespace Signaturgruppen\SPS\Api\Frame\NemID {

    use Signaturgruppen\SPS\Api\Frame\Language;

    use Signaturgruppen\SPS\Api\Frame\FlowConfig;

    class OcesFlowConfig extends FlowConfig
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
        public $Language;

        /**
         * @var SignProperty[]
         */
        public $SignProperties;

    };
}

