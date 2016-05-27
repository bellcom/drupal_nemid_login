<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Frame;

use Signaturgruppen\SPS\Crypto\UUID;

const TRANSACTION_ID_KEY = "TransactionIdentifier";

class Session
{
    public static $Enabled = true;

    public static function createTransactionId()
    {
        if (Session::$Enabled) {
            return Session::doCreateAndSet();
        }
        return UUID::createNew();
    }

    /**
     * @return string
     */
    private static function doCreateAndSet()
    {
        if (session_id() == "") {
            session_start();
        }
        if (!isset($_SESSION[TRANSACTION_ID_KEY])) {
            $_SESSION[TRANSACTION_ID_KEY] = UUID::createNew();
        }
        return $_SESSION[TRANSACTION_ID_KEY];
    }

    public static function getTransactionId()
    {
        if (Session::$Enabled) {
            return Session::doGetAndRemove();
        }
        return null;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private static function doGetAndRemove()
    {
        if (session_id() == "") {
            session_start();
        }
        if (!isset($_SESSION[TRANSACTION_ID_KEY])) {
            throw new \Exception("No transaction id set in session");
        }
        $transactionId = $_SESSION[TRANSACTION_ID_KEY];
        unset($_SESSION[TRANSACTION_ID_KEY]);
        return $transactionId;
    }
}