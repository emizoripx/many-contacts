<?php

namespace EmizorIpx\ManyContacts\Request\ManyContacts;

use EmizorIpx\ManyContacts\Messages\ManyContacts\Message;

abstract class Request
{
    protected $api_key;

    protected $uri;

    protected $message;

    protected $body;

    protected $encoded_body;

    protected $body_type;

    public function  __construct(Message $message, string $api_key, string $uri)
    {
        $this->api_key = $api_key;

        $this->uri = $uri;

        $this->message = $message;

        $this->makeBody();

        $this->encodeBody();
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getEncodedBody()
    {
        return $this->encoded_body;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return [
            'apikey' => $this->api_key,
            'Content-Type' => 'application/json'
        ];
    }

    public function getBodyType(): string
    {
        return 'body';
    }

    protected function encodeBody(): void
    {
        $this->encoded_body = json_encode($this->getBody());
    }

    abstract protected function makeBody();
}
