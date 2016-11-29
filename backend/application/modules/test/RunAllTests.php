<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
require_once 'components/ActionLoader/interface/ActionInterface.php';

class RunAllTests implements ActionInterface
{
    public function execute()
    {
        include_once 'components/DatabaseHandler/test/test.php';
        include_once 'components/Encryptor/test/test.php';
        include_once 'components/Validator/test/test.php';
    }
}
?>