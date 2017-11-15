<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface RestApiClientInterface
{
	public function setUrl($url);
	public function setMethod($method);
	public function setData($data);
	public function sendRequest();
}
?>
