<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ComponentFactory/ComponentFactory.php';
include_once 'components/DatabaseHandler/DatabaseHandler.php';
include_once 'components/DatabaseHandler/test/testConfiguration.php';

echo '<h1>*************************DatabaseHandler Test***************************</h1>';
$dbh = ComponentFactory::create('DatabaseHandler');

if($dbh) 
{
    echo '<h2>CREATION: OK</h2>';
} 
else
{
    echo '<h2>CREATION: FAIL</h2>';
}

$sql = 'select users.username from users';
echo '<h2>SELECT ALL USERS: </h2>';
echo json_encode( $dbh->exec($sql) );
echo '<br>';

$sql = 'select users.username from users where users.id = ?';
$param = 1;
echo '<h2>SELECT USER WITH ID 1: </h2>';
echo json_encode( $dbh->exec($sql, $param) );
echo '<br>';

$sql = 'select users.username from users where users.id = ? and users.username = ?';
$parameters = array('1', 'admin');
echo '<h2>SELECT USERS BY NAME AND ID: </h2>';
echo json_encode( $dbh->exec($sql, $parameters) );
echo '<br>';
?>