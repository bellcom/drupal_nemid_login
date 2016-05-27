<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    use Signaturgruppen\SPS\Api\Body;

    class DocumentPendingRequest extends Body
    {
        public function mustEncrypt()
        {
            return false;
        }

        public function mustSign()
        {
            return true;
        }

    };
}

