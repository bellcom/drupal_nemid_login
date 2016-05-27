<?php

namespace Signaturgruppen\SPS\Api\Services\Monitoring {

    use Signaturgruppen\SPS\Api\Webservice;
    use Signaturgruppen\SPS\Transport\WebserviceClient;

    abstract class MonitoringWebservice implements Webservice
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
            return "Monitoring";
        }

        /**
         * @param StatusRequest $request
         * @return StatusResponse
         */
        public abstract function getStatus(StatusRequest $request);

    }
}

