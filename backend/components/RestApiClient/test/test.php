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

// $client->setUrl('http://www.ultubrokers.com.ar:21000/ultudemo/interfaces/ultu/KimnInsuranceServices.svc/public/GenerateAutoBudget');
// $data = array(  "login"=> "cotizador",   
// 				"password"=> "cotizador",   
// 				"budget"=> array(    
// 				"tipoIva"=> "Inscripto",    
// 				"tipoIIBB"=>"Consumidor Final",    
// 				"tipoViaDeCobro"=>"TARJETA CREDITO"   ),   
// 				"item"=>array(    "anio"=> "2015",    
// 				"codigo"=>"460730",    "codigoPostal"=>"1903",      
// 				"esCeroKm"=>false,    
// 				"estadoCivil"=>"Soltero(a)",      
// 				"fechaNacimiento"=>"/Date(383799600000-0300)/",    
// 				"provincia"=> "BUENOS AIRES",    
// 				"localidad"=> "ABASTO",    
// 				"sexo"=> "Masculino"   )
// 			);
// $client->setData($data);

$result = $client->sendRequest();

var_dump($result);
?>
