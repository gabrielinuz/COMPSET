<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
include_once 'components/ComponentFactory/interface/FactoryInterface.php';

class ComponentFactory implements FactoryInterface
{
    public static function create($component)
    {
        require_once 'components/'.$component.'/'.$component.'.php';
        return new $component;
    }
}
?>