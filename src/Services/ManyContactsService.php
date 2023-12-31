<?php

namespace EmizorIpx\ManyContacts\Services;

use EmizorIpx\ManyContacts\Exceptions\ManyContactsException;
use EmizorIpx\ManyContacts\Exceptions\ResponseManyContactsException;
use EmizorIpx\ManyContacts\Http\ManyContactsClient;
use EmizorIpx\ManyContacts\Messages\ManyContacts\TextMessage;
use EmizorIpx\ManyContacts\Request\ManyContacts\RequestTextMessage;
use Exception;
use GuzzleHttp\Exception\RequestException;

class ManyContactsService
{

    protected $number_phone;

    protected $api_key;

    protected $prepared_data;

    protected $client;

    protected $parsed_response;

    public function __construct()
    {
        $this->validateSettings();

        $this->api_key = config('manycontacts.manycontacts_api_key');

        $this->client = new ManyContactsClient();
    }

    public function validateSettings(): void
    {

        if (empty(config('manycontacts.manycontacts_api_host'))) {
            throw new ManyContactsException('ManyContacts Host no encontrado, se debe configurar en el .ENV');
        }

        if (empty(config('manycontacts.manycontacts_api_key'))) {
            throw new ManyContactsException('Api Token requerido');
        }
    }

    public function setNumberPhone(string $value): void
    {
        $this->number_phone = $value;
    }

    public function setParsedResponse($value): void
    {
        $this->parsed_response = $value;
    }

    public function setPreparedData($value): void
    {
        $this->prepared_data = $value;
    }

    public function getPreparedData()
    {
        return $this->prepared_data;
    }

    public function sendTextMessage(string $number_phone, string $text)
    {
        try {

            $message = new TextMessage($number_phone, $text);

            $request = new RequestTextMessage($message, $this->api_key, RequestTextMessage::URI);

            $this->setPreparedData($request->getBody());

            $response = $this->client->sendRequest($request);

            $this->setParsedResponse($response->getDecodedBody());

            return $response;
        } catch (RequestException $rex) {

            \Log::debug("Error de conexión al enviar el mensaje " . $rex->getResponse()->getBody());

            throw new ManyContactsException($rex->getResponse()->getBody(), true);

        } catch (ResponseManyContactsException $rsex) {

            \Log::debug("Error Reponse whatsapp Service: " . $rsex->getResponseData() . ' Staus Code: ' . $rsex->getHttpStatusCode());

            throw new ManyContactsException($rsex->getResponseData(), true);

        } catch (Exception $ex) {

            \Log::debug("Ocurrio un excepción al enviar el Mensaje: " . $ex->getMessage() . ' File: ' . $ex->getFile() . ' Line: ' . $ex->getLine());

            throw new ManyContactsException($ex->getMessage());
        }
    }
}

