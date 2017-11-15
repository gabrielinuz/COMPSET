<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
include_once 'components/RestApiClient/interface/RestApiClientInterface.php';

class RestApiClient implements RestApiClientInterface
{
	private $url;
	private $data;
	private $method;

	public function __construct()
	{
		$this->setMethod('post');
	}	

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function sendRequest()
	{
		switch ($this->method) 
		{
			case 'post':
			case 'POST':
				$this->method = 'POST';		
				break;
			
			case 'get':
			case 'GET':
				$this->method = 'GET';
				break;

			case 'put':
			case 'PUT':
				$this->method = 'PUT';
				break;

			case 'delete':
			case 'DELETE':
				$this->method = 'DELETE';
				break;
		}

		$httpData = array('method' => $this->method,);

		if (!empty($this->data)) 
		{
			$jsonString = json_encode($this->data); 	
			$httpData = array('method' => $this->method,
							  'header' => 'Content-Type: application/json' . "\r\n"
							  . 'Content-Length: ' . strlen($jsonString) . "\r\n",
							  'content' => $jsonString,
							 );
		}

		$streamContext = stream_context_create(array('http' => $httpData) );
		$result = file_get_contents($this->url,null,$streamContext);	
		return $result;	
	}
}
?>