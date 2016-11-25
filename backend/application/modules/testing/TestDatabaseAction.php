<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ActionLoader/interface/ActionInterface.php';

class TestDatabaseAction implements ActionInterface
{
    public function execute()
    {
        $dbh = ComponentFactory::create('DatabaseHandler');
        $sql = 'select users.username from users where users.id = ?';
        $param = $_REQUEST['identifier'];
        echo json_encode( $dbh->exec($sql, $param) );
    }
}
?>