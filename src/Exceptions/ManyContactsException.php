<?php

namespace EmizorIpx\ManyContacts\Exceptions;

use Exception;

class ManyContactsException extends Exception
{
    public function __construct($msg, $exception_service = false)
    {
        $finalMessage = ['error' => ''];
        \Log::debug("Many Contacts >>>>>>>>>>>>>>> ", [$msg]);

        if ($msg != null) {
            $finalMessage = [
                'errors' => $exception_service ? json_decode($msg) : [
                    'message' =>  $msg
                ],
                'message_key' => ''
            ];
        }

        parent::__construct(json_encode($finalMessage));
    }
}

