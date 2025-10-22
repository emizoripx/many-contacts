<?php

namespace EmizorIpx\ManyContacts\Http;

use EmizorIpx\ManyContacts\Request\ManyContacts\Request;
use EmizorIpx\ManyContacts\Response\Response;

class ManyContactsClient
{
    const API_VERSION = 'v1';
    const API_VERSION_2 = 'v2';

    protected $client_handler;

    public function __construct()
    {
        $this->client_handler = $this->defaultHandler();
    }

    public function sendRequest(Request $request, string $api_version = self::API_VERSION)
    {
        \Log::debug("Send to URL: " . $this->buildRequestUri($request, $api_version));
        \Log::debug("Body to Send: ", [$request->getEncodedBody()]);
        \Log::debug("Headers to Send: " . json_encode($request->getHeaders()));

        $response = $this->client_handler->send(
            $this->buildRequestUri($request, $api_version),
            $request->getEncodedBody(),
            $request->getHeaders(),
            $request->getBodyType()
        );

        $return_response = new Response($request, $response->getBody(), $response->getStatusCode(), $response->getHeaders());

        if ($return_response->isError()) {
            $return_response->throwException();
        }

        return $return_response;
    }

    private function defaultHandler(): GuzzleClientHandler
    {
        return new GuzzleClientHandler();
    }

    private function getHost(): ?string
    {
        return config('manycontacts.manycontacts_api_host');
    }

    private function buildRequestUri(Request $request, string $api_version): string
    {
        return $this->getHost() . '/' . $api_version . '/' . $request->getUri();
    }
}

