<?php

namespace EmizorIpx\ManyContacts\Request\ManyContacts;

class RequestTemplateWithVariablesMessage extends Request
{
    const URI = 'template/%s/%s';

    protected function makeBody()
    {
        $this->body = [
            "variables" => $this->message->getVariables()
        ];
    }
}
