<?php

namespace Signaturgruppen\SPS\Api\Frame\NemID {

    class AuthenticationInfo
    {
        /**
         * @var string|null
         */
        public $Pid;

        /**
         * @var string|null
         */
        public $Dn;

        /**
         * @var string|null
         */
        public $CommonName;

        /**
         * @var string|null
         */
        public $Rid;

        /**
         * @var string|null
         */
        public $Cpr;

        /**
         * @var string|null
         */
        public $Cvr;

        /**
         * @var string|null
         */
        public $Email;

        /**
         * @var string|null
         */
        public $SignedXml;

        /**
         * @var string|null
         */
        public $IssuerDn;

        /**
         * @var bool|null
         */
        public $IsYouthCert;

        /**
         * @var string|null
         */
        public $CertificateType;

        /**
         * @var string|null
         */
        public $SubjectSerialNumber;

        /**
         * @var SignProperty[]
         */
        public $SignProperties;

    };
}

