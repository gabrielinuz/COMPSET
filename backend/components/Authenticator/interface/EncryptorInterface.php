<?php
/**
* Copyright (c) Pablo Daniel Spennato <pdspennato@gmail.com> 
* and 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface EncryptorInterface
{		
	public function encrypt($text);
	public function verify($inputPassword, $storedPasswordHash);
}
?>