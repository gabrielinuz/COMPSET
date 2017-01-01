<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

class ConfigurationManager
{
    private $vars;
    private static $instance;

    private function __construct()
    {
        $this->vars = array();
    }

    public function set($name, $value)
    {
        if(!isset($this->vars[$name]))
        {
            $this->vars[$name] = $value;
        }
    }

    public function get($name)
    {
        if(isset($this->vars[$name]))
        {
            return $this->vars[$name];
        }
    }

    public static function instance()
    {
        if (!isset(self::$instance))
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
}
?>
