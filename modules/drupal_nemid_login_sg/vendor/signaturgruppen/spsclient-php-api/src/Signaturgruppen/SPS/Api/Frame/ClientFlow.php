<?php

namespace Signaturgruppen\SPS\Api\Frame {

    final class ClientFlow
    {
        private function __construct()
        {
        }

        const NemID = "NemID";
        const NemIDSignature = "NemIDSignature";
        const NemIDKeyFile = "NemIDKeyFile";
        const NemIDKeyFileSignature = "NemIDKeyFileSignature";
        const Invalid = "Invalid";
    }
}

