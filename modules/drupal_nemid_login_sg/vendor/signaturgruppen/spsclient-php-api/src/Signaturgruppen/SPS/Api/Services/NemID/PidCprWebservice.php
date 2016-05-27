<?php

namespace Signaturgruppen\SPS\Api\Services\NemID {

    use Signaturgruppen\SPS\Api\Webservice;
    use Signaturgruppen\SPS\Transport\WebserviceClient;

    abstract class PidCprWebservice implements Webservice
    {
        protected $client;

        /**
         * @param WebserviceClient $client
         */
        public function __construct(WebserviceClient $client)
        {
            $this->client = $client;
        }

        public function getEndpoint()
        {
            return "PidCpr";
        }

        /**
         * @param MatchPidCprRequest $request
         * @return MatchPidCprResponse
         */
        public abstract function match(MatchPidCprRequest $request);

    }
}

