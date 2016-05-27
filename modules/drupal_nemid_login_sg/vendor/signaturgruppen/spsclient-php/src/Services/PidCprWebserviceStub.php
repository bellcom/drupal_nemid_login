<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Services;


use Signaturgruppen\SPS\Api\Services\NemID\MatchPidCprRequest;
use Signaturgruppen\SPS\Api\Services\NemID\MatchPidCprResponse;
use Signaturgruppen\SPS\Api\Services\NemID\PidCprWebservice;

class PidCprWebserviceStub extends PidCprWebservice
{

    /**
     * @param MatchPidCprRequest $request
     * @return MatchPidCprResponse
     */
    public function match(MatchPidCprRequest $request)
    {
        return $this->client->invoke($request, $this, "Match");
    }
}