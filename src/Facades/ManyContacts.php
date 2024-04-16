<?php

namespace EmizorIpx\ManyContacts\Facades;

use EmizorIpx\ManyContacts\Data\MediaMessageData;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string|array sendTextMessage( string $phone_number, string $text)
 * @method static string|array sendTemplateMediaMessage( string $phone_number, string $template, MediaMessageData $data)
 */

class ManyContacts extends Facade
{


    protected static function getFacadeAccessor()
    {
        return 'send_whatsapp_text_message';
    }
}

