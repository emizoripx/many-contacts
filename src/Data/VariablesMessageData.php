<?php

namespace EmizorIpx\ManyContacts\Data;

class VariablesMessageData
{

    protected $variables;

    public function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function toArray()
    {
        return [
            "variables" => $this->variables
        ];
    }
}
