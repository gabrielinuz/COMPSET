<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
include_once 'components/Responder/interface/ResponderInterface.php';

class JsonResponder implements ResponderInterface
{
    private $httpState;

    public function setHttpState($state)
    {
        $this->httpState = $state;
    }

    public function respond($response)
    {
        if ($this->httpState) 
        {
            http_response_code($this->httpState);
        }

        header('Content-Type: application/json; charset=utf8');
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }
}