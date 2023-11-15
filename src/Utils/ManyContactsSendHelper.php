<?php

namespace EmizorIpx\ManyContacts\Utils;

use Carbon\Carbon;
use EmizorIpx\ManyContacts\Exceptions\ManyContactsException;
use EmizorIpx\ManyContacts\Models\WhatsappMessage;
use EmizorIpx\ManyContacts\Services\ManyContactsService;
use Exception;

class ManyContactsSendHelper
{
    public function sendTextMessage(string $number_phone, string $text)
    {
        try {

            $message_key = strtoupper(str_replace('.', '', uniqid('', true)));

            if (is_null($number_phone) || empty($number_phone)) {

                throw new ManyContactsException('Número de Teléfono requerido');
            }

            $whatsapp_message = WhatsappMessage::query()->create([
                'message_key' => $message_key,
                'number_phone' => $number_phone,
            ]);

            $many_contacts_service = new ManyContactsService();

            $response = $many_contacts_service->sendTextMessage($number_phone, $text);

            $response_decoded = $response->getDecodedBody();
            \Log::debug("Reponse Cloud Whatsapp Send: " . json_encode($response->getDecodedBody()));

            $whatsapp_message->update([
                'status' => WhatsappMessage::SUCCESS_STATUS,
                'state' => WhatsappMessage::DISPATCHED_STATE,
                'message_id' => $response_decoded['id'],
                'dispatched_date' => Carbon::now()->toDateTimeString(),
                'message' => json_encode($many_contacts_service->getPreparedData())
            ]);

            return ['message_key' => $message_key, 'message' => WhatsappMessageStates::getDescriptionState(WhatsappMessage::DISPATCHED_STATE)];
        } catch (ManyContactsException | Exception $ex) {

            \Log::debug("Exception in Helpers " . $ex->getMessage() . "File: " . $ex->getFile() . " Line: " . $ex->getLine());

            if (isset($whatsapp_message)) {
                $whatsapp_message->update([
                    'errors' => $ex->getMessage(),
                    'billable' => 0
                ]);
            }
            $msg = $ex->getMessage();
            if ($ex instanceof ManyContactsException) {
                $msg = json_decode($msg);
                $msg->message_key = $message_key;
                $msg = json_encode($msg);
                \Log::debug("Error return " . $msg);
            }

            throw new ManyContactsException($msg);
        }
    }
}

