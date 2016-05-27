<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Services;


use Signaturgruppen\SPS\Api\Services\NemID\MatchPidCprRequest;
use Signaturgruppen\SPS\Configuration\Config;
use Signaturgruppen\SPS\Transport\WebserviceClient;

class PidMatchService
{
    /**
     * @param $pid
     * @param $cpr
     * @return bool
     */
    public function pidMatchesCpr($pid, $cpr)
    {
        $request = new MatchPidCprRequest();
        $request->Cpr = $cpr;
        $request->Pid = $pid;
        $response = $this->getStub()->match($request);
        return $response->Match;
    }

    /**
     * @return PidCprWebserviceStub
     */
    private function getStub()
    {
        $config = Config::getDefault();
        return new PidCprWebserviceStub(WebserviceClient::fromConfig($config));
    }
}