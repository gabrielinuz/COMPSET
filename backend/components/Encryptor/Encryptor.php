<?php
/**
* Copyright (c) Pablo Daniel Spennato <pdspennato@gmail.com> 
* and 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/Encryptor/interface/EncryptorInterface.php';
    
class Encryptor implements EncryptorInterface
{
    /*TEST EXAMPLE HASH FOR 12345*/
    /*  dfffab671caa8f4e347fa9556e53c16e274f23d927b473071360f7763b83311d */
    public function __construct()
    {
        if (!defined('AUTH_HASH_METHOD')) {  define('AUTH_HASH_METHOD', 'sha256');}
        if (!defined('AUTH_HASH_KEY')) {  define('AUTH_HASH_KEY', 'c3M@eo|');}
    }

    public function encrypt($text)
    {
        return hash_hmac(AUTH_HASH_METHOD, $text, AUTH_HASH_KEY);
    }

    public function verify($inputPassword, $storedPasswordHash)
    {
        $inputHash = hash_hmac(AUTH_HASH_METHOD, $inputPassword, AUTH_HASH_KEY);
        return (md5($inputHash) === md5($storedPasswordHash));
    }
}
?>
