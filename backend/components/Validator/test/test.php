<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ComponentFactory/ComponentFactory.php';
require_once 'components/Validator/Validator.php';

echo '<h1>*************************Validator Test***************************</h1>';

$validator = ComponentFactory::create('Validator');

if($validator) 
{
    echo '<h2>CREATION: OK</h2>';
} 
else
{
    echo '<h2>CREATION: FAIL</h2>';
}

$validMail = 'pepe@gmail.com';
echo '<h2>VALID MAIL ' . $validMail . ': </h2>';
echo $validator->validateThis($validMail)->like('email');

$invalidMail = 'pepe';
echo '<h2>INVALID MAIL ' . $invalidMail . ': </h2>';
echo $validator->validateThis($invalidMail)->like('email');
?>