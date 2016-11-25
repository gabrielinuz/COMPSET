<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
include_once 'components/Validator/interface/ValidationInterface.php';

class Email implements ValidationInterface
{
    public function evaluate($target)
    {
        if (strlen($target) >= 255 ) die(CT_EXCEEDED_CHARS . ' =>' . $target);
        $regex = "/^([a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4})?$/";
        $is_valid = preg_match($regex, $target);
        if (!$is_valid) die(CT_VALID_EMAIL . ' =>' . $target);
        return $target;
    }
}
?>