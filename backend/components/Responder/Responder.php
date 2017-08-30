<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
include_once 'components/Responder/interface/ResponderInterface.php';

class Responder implements ResponderInterface
{
	private $responder;

	public function __construct()
	{
		$responseType = $_POST['responseType'];
		switch ($responseType) 
		{
			case 'json':
				$this->responder = ComponentFactory::create('JsonResponder')
				break;
			
			default:
				$this->responder = ComponentFactory::create('XmlResponder')
				break;
		}
	}

	public function setHttpState($state)
    {
        $this->responder->setHttpState($state);
    }

    public function response($content)
    {
    	$this->responder->response($content);
    }
}
?>
