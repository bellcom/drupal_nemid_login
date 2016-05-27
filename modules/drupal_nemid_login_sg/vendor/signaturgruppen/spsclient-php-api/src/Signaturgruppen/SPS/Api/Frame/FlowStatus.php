<?php

namespace Signaturgruppen\SPS\Api\Frame {

    final class FlowStatus
    {
        private function __construct()
        {
        }

        const Ok = "Ok";
        const UserCancel = "UserCancel";
        const ClientFlowError = "ClientFlowError";
        const FlowError = "FlowError";
    }
}

