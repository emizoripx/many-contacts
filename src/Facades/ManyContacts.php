<?php

namespace EmizorIpx\ManyContacts\Facades;

use EmizorIpx\ManyContacts\Data\MediaMessageData;
use EmizorIpx\ManyContacts\Data\VariablesMessageData;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string|array sendTextMessage( string $phone_number, string $text)
 * @method static string|array sendTemplateMediaMessage( string $phone_number, string $template, MediaMessageData $data)
 * @method static string|array sendTemplateWithVariablesMessage( string $phone_number, string $template, VariablesMessageData $data)
 */

class ManyContacts extends Facade
{


    protected static function getFacadeAccessor()
    {
        return 'send_whatsapp_text_message';
    }
}
