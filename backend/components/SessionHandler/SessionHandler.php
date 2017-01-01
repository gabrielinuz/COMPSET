<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/SessionHandler/interface/SessionHandlerInterface.php';

class SessionHandler implements SessionHandlerInterface
{
    public function __construct()
    {
        include 'components/SoapClientWrapper/ConfigurationManager.php';
        include 'components/SoapClientWrapper/configuration.php';
        $this->cm = ConfigurationManager::instance();
        session_id( $this->cm->get('sessionId') );
    }

    public function start()
    {
        $cl = $this->cm->get('cookieLifetime')
        session_start(['cookie_lifetime' => $cl,]);
    }

    public function set($key, $value)
    {
        $_SESSION["$key"] = $value;
    }

    public function get($key)
    {
        if( !isset($_SESSION["$key"]) && empty($_SESSION["$key"]) ) $_SESSION["$key"]) = NULL;
        return $_SESSION["$key"];
    }

    public function delete($key)
    {
        if( isset($_SESSION["$key"]) && !empty($_SESSION["$key"]) ) $_SESSION["$key"]) = NULL;
    }

    public function destroy()
    {
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}
?>