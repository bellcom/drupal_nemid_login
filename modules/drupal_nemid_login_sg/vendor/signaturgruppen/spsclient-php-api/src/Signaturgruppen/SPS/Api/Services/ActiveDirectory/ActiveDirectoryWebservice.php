<?php

namespace Signaturgruppen\SPS\Api\Services\ActiveDirectory {

    use Signaturgruppen\SPS\Api\Webservice;
    use Signaturgruppen\SPS\Transport\WebserviceClient;

    abstract class ActiveDirectoryWebservice implements Webservice
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
            return "ActiveDirectory";
        }

        /**
         * @param ValidateCredentialsRequest $request
         * @return ValidateCredentialsResponse
         */
        public abstract function validateCredentials(ValidateCredentialsRequest $request);

        /**
         * @param UserInfoRequest $request
         * @return UserInfoResponse
         */
        public abstract function getUserInfo(UserInfoRequest $request);

    }
}

