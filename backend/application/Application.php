<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
require_once 'components/ComponentFactory/ComponentFactory.php';

final class Application
{
    public static function run()
    {
    /*SANITIZER*/
        $inputSanitizer = ComponentFactory::create('TextInputSanitizer');
        if (isset($_REQUEST)) $_REQUEST = $inputSanitizer->sanitize($_REQUEST); 
    /*SANITIZER*/

    /*TEST AUTHENTICATOR*/
        $authenticator = ComponentFactory::create('Authenticator');
        $authenticator->setDBHandler( ComponentFactory::create('DatabaseHandler') );
        $authenticator->setEncryptor( ComponentFactory::create('Encryptor') );
        $authenticated = $authenticator->authenticate($_REQUEST['user'], $_REQUEST['password']);
        if (!$authenticated) die('authentication error');
    /*TEST AUTHENTICATOR*/

    /*ACTION CONSTRUCT*/
        $actionData = explode('/', $_REQUEST['action']);
        $actionModule = $actionData[0]; 
        $actionClass = $actionData[1];
        require_once('application/modules/'.$actionModule.'/'.$actionClass.'.php');
        $actionObject = new $actionClass;
    /*ACTION CONSTRUCT*/

    /*TEST AUTHORIZER*/
        $authorizer = ComponentFactory::create('Authorizer');
        $authorizer->setAuthenticator($authenticator);
        $authorized = $authorizer->authorize($actionObject);    
        if (!$authorized) die('authorization error');
    /*TEST AUTHORIZER*/
        
    /*ACTION LOADER*/
        $actionLoader = ComponentFactory::create('ActionLoader');
        $actionLoader->load($actionObject);
    /*ACTION LOADER*/
    }
}
?>