<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
include_once 'components/Validator/interface/ValidatorInterface.php';
include_once 'components/Validator/interface/ValidationInterface.php';

class Validator implements ValidatorInterface
{
    // public function __construct()
    // {
            // $this->target = '';
            // $this->response = '';
    // }

    public function validateThis($target)
    {
        $this->target = $target;
        return $this;
    }

    public function like($type)
    {
        $uctype = ucfirst($type);
        $validationClass = "{$uctype}";
        require_once 'components/Validator/validations/'.$validationClass.'.php';
        if(class_exists($validationClass))
        {
            $class = new ReflectionClass($validationClass);
            if($class->implementsInterface('ValidationInterface'))
            {
                require_once 'components/Validator/messages.php';
                $validationObject = new $validationClass;
                $response = $validationObject->evaluate($this->target);
            }
        }

        return $response;
    }
}
?>