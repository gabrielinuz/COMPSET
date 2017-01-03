<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/


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
