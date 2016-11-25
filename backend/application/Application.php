<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
require_once 'components/ComponentFactory/ComponentFactory.php';

final class Application
{
    public static function run()
    {
        $inputSanitizer = ComponentFactory::create('TextInputSanitizer');
        if (isset($_REQUEST)) $_REQUEST = $inputSanitizer->sanitize($_REQUEST); 
        $actionData = explode('/', $_REQUEST['action']);
        $actionModule = $actionData[0]; 
        $actionClass = $actionData[1];
       
        require_once('application/modules/'.$actionModule.'/'.$actionClass.'.php');
        $actionObject = new $actionClass;
        
        $actionLoader = ComponentFactory::create('ActionLoader');
        $actionLoader->load($actionObject);
    }
}
?>