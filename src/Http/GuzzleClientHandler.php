<?php

namespace EmizorIpx\ManyContacts\Http;

use GuzzleHttp\Client;

class GuzzleClientHandler {

    protected $guzzle_client ;

    public function __construct( ?Client $guzzle_client = null )
    {
        $this->guzzle_client = $guzzle_client ?: new Client();

    }

    public function send( string $url, $body, array $headers, string $body_type = 'body' ){

        \Log::debug('Request: ', [
            $body_type => $body,
            'headers' => $headers
        ]);

        $response = $this->guzzle_client->post( $url, [
            $body_type => $body,
            'headers' => $headers
        ]);

        return $response;

    }

}

