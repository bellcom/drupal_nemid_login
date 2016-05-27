<?php

namespace Signaturgruppen\SPS\Api\Services\ActiveDirectory {

    final class AdValidationStatus
    {
        private function __construct()
        {
        }

        const OkCredentialsNotValidated = "OkCredentialsNotValidated";
        const OkCredentialsValidated = "OkCredentialsValidated";
        const NotExists = "NotExists";
        const NotAllowedToAuthenticate = "NotAllowedToAuthenticate";
        const InvalidCredentials = "InvalidCredentials";
        const Error = "Error";
    }
}

