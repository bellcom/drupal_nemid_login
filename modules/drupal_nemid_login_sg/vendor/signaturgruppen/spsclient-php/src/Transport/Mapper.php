<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

use JsonMapper;

class Mapper
{

    /**
     * @param string $jsonString
     * @param string $className
     * @return object
     * @throws \JsonMapper_Exception
     */
    public static function deserialize($jsonString, $className)
    {
        $r = new \ReflectionClass($className);
        $newInstance = $r->newInstance();

        $mapper = new JsonMapper();
        $mapper->bExceptionOnMissingData = false;
        $json = json_decode($jsonString);
        return $mapper->map($json, $newInstance);
    }

}