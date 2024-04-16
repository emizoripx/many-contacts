<?php

namespace EmizorIpx\ManyContacts\Request\ManyContacts;

use GuzzleHttp\Psr7;

class RequestTemplateMediaMessage extends Request
{
    const URI = 'template/%s/%s/media';

    const BODY_TYPE = 'multipart';

    protected function makeBody(): void
    {
        $this->body = [
            'file' => $this->message->getFile(),
            'text' => $this->message->getText()
        ];
    }

    protected function encodeBody(): void
    {
        $array_body = [];

        if (isset($this->body['file']) and !is_null($this->body['file'])) {

            $array_body[] = ['name' => 'file', 'contents' => Psr7\Utils::tryFopen($this->body['file'], 'r')];
        }

        if (isset($this->body['text']) and !is_null($this->body['text'])) {

            $array_body[] = [ 'name' => 'text', 'contents' => $this->body['text']];
        }

        $this->encoded_body = $array_body;
    }

    public function getHeaders(): array
    {
        return [
            'apikey' => $this->api_key,
        ];
    }

    public function getBodyType(): string
    {
        return 'multipart';
    }
}
