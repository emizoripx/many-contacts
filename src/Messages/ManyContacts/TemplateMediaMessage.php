<?php

namespace EmizorIpx\ManyContacts\Messages\ManyContacts;

class TemplateMediaMessage extends Message
{
    protected $file;

    protected $text;

    public function __construct(string $number_phone, string $file, ?string $text)
    {

        parent::__construct($number_phone);

        $this->file = $file;

        $this->text = $text;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
