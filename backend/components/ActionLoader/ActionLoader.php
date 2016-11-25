<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
require_once 'components/ActionLoader/interface/LoaderInterface.php';
require_once 'components/ActionLoader/interface/ActionInterface.php';

class ActionLoader implements LoaderInterface
{
    public function load(ActionInterface $action)
    {
        $action->execute();
    }
}
?>