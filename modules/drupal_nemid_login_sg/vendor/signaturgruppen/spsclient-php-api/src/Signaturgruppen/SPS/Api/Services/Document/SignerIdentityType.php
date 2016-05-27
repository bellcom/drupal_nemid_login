<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    final class SignerIdentityType
    {
        private function __construct()
        {
        }

        const SignerIdentifier = "SignerIdentifier";
        const DanishCvr = "DanishCvr";
        const NemIdPid = "NemIdPid";
        const NemIdRid = "NemIdRid";
    }
}

