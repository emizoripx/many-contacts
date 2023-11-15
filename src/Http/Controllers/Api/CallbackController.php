<?php

namespace EmizorIpx\ManyContacts\Http\Controllers\Api;

use EmizorIpx\ManyContacts\Events\ManyContactsResponseMessageReceived;
use EmizorIpx\ManyContacts\Models\WhatsappMessage;
use EmizorIpx\ManyContacts\Response\CallbackManyContactsResponse;
use EmizorIpx\ManyContacts\Utils\WhatsappMessageStates;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CallbackController extends Controller
{

    public function callback(Request $request)
    {

        \Log::debug("WHATSAPP CLOUD API Callback INIT >>>>>>>>>>>>>>>>>>>>>> " . $request->getHost());

        $data = $request->all();

        \Log::debug(" WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Callback Data: " . json_encode($data));

        $callback_reponse = new CallbackManyContactsResponse($data);

        if (!is_null($callback_reponse->getResponseMessage())) {

            // TODO: Send Event
            event(new ManyContactsResponseMessageReceived($callback_reponse));

            return;
        }

        if (empty($callback_reponse->getStatusesData())) {

            \Log::debug("WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Nose encontró Notificación de Estado");

            return;
        }

        if (empty($callback_reponse->getMessageId()) || is_null($callback_reponse->getMessageId())) {

            \Log::debug("WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Message ID no Recibido");

            return;
        }

        \Log::debug('Message ID: ' . $callback_reponse->getMessageId());

        $message = WhatsappMessage::where('message_id', $callback_reponse->getMessageId())->first();

        if (!$message) {

            \Log::debug("WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Mensaje no encontrado");

            return;
        }

        $data_update = [
            'last_callback_reponse' => json_encode($callback_reponse->getBody())
        ];

        if ($callback_reponse->getStateMessage()) {

            $data_update = array_merge($data_update, [
                'status' => $callback_reponse->getStateMessage() == WhatsappMessage::FAILED_STATE ? $callback_reponse->getStateMessage() : 'success',
                'state' => $callback_reponse->getStateMessage(),
                'status_description' => WhatsappMessageStates::getDescriptionState($callback_reponse->getStateMessage())
            ]);
        }

        if ($callback_reponse->getMessageErrors()) {

            $data_update = array_merge($data_update, [
                'error_details' => json_encode($callback_reponse->getMessageErrors())
            ]);
        }

        if ($callback_reponse->getErrors()) {

            $data_update = array_merge($data_update, [
                'errors' => json_encode($callback_reponse->getErrors())
            ]);
        }

        if ($callback_reponse->getTimestamp()) {

            $data_update = array_merge($data_update, WhatsappMessageStates::setStateDate($callback_reponse->getStateMessage(), $callback_reponse->getTimestamp()));
        }

        $message->update($data_update);


        return;
    }
}
