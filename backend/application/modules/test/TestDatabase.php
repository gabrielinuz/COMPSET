<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ActionLoader/interface/ActionInterface.php';

class TestDatabase implements ActionInterface
{
    public function execute()
    {
        //$dbh = ComponentFactory::create('DatabaseHandler');
        //echo json_encode( $dbh->exec('select users.username from users') );
        //TODO:
        $dataBaseHandler = ComponentFactory::create('DatabaseHandler');
        $response = $dataBaseHandler->exec('prGetUsers');
        $responder = ComponentFactory::create('Responder');
        $responder->respond($response);

    }
}
?>