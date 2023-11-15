<?php

namespace EmizorIpx\ManyContacts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|array sendTextMessage( string $phone_number, string $text)
 */

class ManyContacts extends Facade
{


    protected static function getFacadeAccessor()
    {
        return 'send_whatsapp_text_message';
    }
}

