<?php

namespace EmizorIpx\ManyContacts\Http\Controllers\Api;

use EmizorIpx\WhatsappCloudapi\Events\WhatsappResponseMessageReceived;
use EmizorIpx\WhatsappCloudapi\Jobs\ForwardCallbackNotification;
use EmizorIpx\WhatsappCloudapi\Models\WhatsappMessage;
use EmizorIpx\WhatsappCloudapi\Response\CallbackManyContactsResponse;
use EmizorIpx\WhatsappCloudapi\Response\CallbackResponse;
use EmizorIpx\WhatsappCloudapi\Utils\WhatsappMessageStates;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CallbackController extends Controller
{

    public function callback( Request $request  ) {

    }

}

