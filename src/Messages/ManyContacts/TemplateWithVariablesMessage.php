<?php

namespace EmizorIpx\ManyContacts\Messages\ManyContacts;

class TemplateWithVariablesMessage extends Message
{
    protected $variables;

    public function __construct(string $number_phone, array $variables)
    {
        parent::__construct($number_phone);

        $this->variables = $variables;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }
}
