<?php

namespace EmizorIpx\ManyContacts\Exceptions;

use EmizorIpx\ManyContacts\Response\Response;
use Exception;

class ResponseManyContactsException extends Exception
{
    protected $response;

    protected $response_data;

    public function __construct(Response $response)
    {

        $this->response = $response;

        $this->response_data = $response->decodeBody();
    }

    public function getHttpStatusCode (){

        return $this->response->getHttpStatusCode();
    }

    public function getRawResponse() {

        return $this->response->getBody();
    }

    public function getResponseData() {

        return $this->response_data;
    }

    public function getResponse() {
        return $this->response;
    }
}

