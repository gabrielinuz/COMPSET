<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/


interface AuthenticatorInterface
{
    public function setDatabaseHandler(DatabaseHandlerInterface $dbh);
    public function getDatabaseHandler();
    public function setEncryptor(EncryptorInterface $encryptor);
    public function getUserId();
    public function authenticate($userName, $password);
}
?>
