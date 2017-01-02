<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// require_once 'components/Authenticator/interface/CSessionHandlerInterface.php';
// require_once 'components/Authenticator/interface/DatabaseHandlerInterface.php';
// require_once 'components/Authenticator/interface/EncryptorInterface.php';

interface AuthenticatorInterface
{
    public function setSessionHandler(CSessionHandlerInterface $sessionHandler);
    public function getSessionHandler();
    public function setDBHandler(DatabaseHandlerInterface $dbh);
    public function getDBHandler();
    public function setEncryptor(EncryptorInterface $encryptor);
    public function authenticate($userName, $password);
}
?>
