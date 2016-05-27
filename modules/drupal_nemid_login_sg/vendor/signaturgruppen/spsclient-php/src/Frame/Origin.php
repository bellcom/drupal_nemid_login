<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Frame;


class Origin
{
    /**
     * Convert a general url to an origin url
     * @param $url
     * @return string
     */
    public static function toOrigin($url)
    {
        $parts = parse_url($url);

        $origin = $parts["scheme"] . "://" . $parts["host"];

        if (array_key_exists("port", $parts)) {
            $origin .= ":" . $parts["port"];
        }
        return $origin;
    }

}