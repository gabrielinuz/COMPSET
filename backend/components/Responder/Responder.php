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
	private $responseType = 'json';

	public function __construct()
	{
		switch ($this->responseType) 
		{
			case 'xml':
				$this->responder = ComponentFactory::create('XmlResponder');		
				break;
			
			case 'json':
				$this->responder = ComponentFactory::create('JsonResponder');
				break;
		}
	}

	public function setResponseType($responseType)
	{
		$this->responseType = $responseType;
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
