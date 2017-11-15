<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ComponentFactory/ComponentFactory.php';
require_once 'components/RestApiClient/RestApiClient.php';

$client = ComponentFactory::create('RestApiClient');

$client->setUrl('https://jsonplaceholder.typicode.com/posts/1');
$client->setMethod('get');

$result = $client->sendRequest();

var_dump($result);
?>
