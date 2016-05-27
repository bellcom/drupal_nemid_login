<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Configuration;

use Signaturgruppen\SPS\Crypto\Certificate;

class Config
{

    private static $DefaultConfig = null;

    /**
     * Get the default configuration.
     *
     * @return object|Config
     * @throws \Exception
     */
    public static function getDefault()
    {
        if (Config::$DefaultConfig == null) {
            throw new \Exception("No default configuration set, use Config::setDefaultConfig or Config::setDefaultConfigFile");
        }
        return Config::$DefaultConfig;
    }

    public static function setDefaultConfigFile($filename)
    {
        Config::$DefaultConfig = Config::fromFile($filename);
    }

    public static function setDefaultConfigJson($json)
    {
        Config::$DefaultConfig = Config::fromText($json);
    }

    /**
     * Read config from a file.
     * @param $filename
     * @return Config
     * @throws \JsonMapper_Exception
     */
    static public function fromFile($filename)
    {
        $configJson = json_decode(file_get_contents($filename));
        return self::fromJson($configJson);
    }

    static public function fromText($text)
    {
        $configJson = json_decode($text);
        return self::fromJson($configJson);
    }

    static public function fromJson($configJson)
    {
        $mapper = new \JsonMapper();
        $config = $mapper->map($configJson, new Config());
        $config->configure();
        return $config;
    }

    public $name;
    public $guid;

    public $pkcs12Encoded;
    public $backendCertificateEncoded;

    private $credentials;
    private $backend;

    /**
     * @var string
     */
    public $backendUrl;

    /**
     * @return string
     */
    public function getBackendUrl()
    {
        return $this->backendUrl;
    }

    /**
     * @return string
     *
     */
    public function getFrameUrl()
    {
        return $this->getBackendUrl() . "/Initialize.aspx";
    }

    /**
     * @param string $backendUrl
     */
    public function setBackendUrl($backendUrl)
    {
        $this->backendUrl = $backendUrl;
    }

    private function configure()
    {
        $this->credentials = new Certificate($this->pkcs12Encoded, true);
        $this->backend = new Certificate($this->backendCertificateEncoded, false);
    }

    /**
     * @return Certificate
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @return Certificate
     */
    public function getBackendCertificate()
    {
        return $this->backend;
    }

    public function getClientIdentifier()
    {
        return $this->guid;
    }

}