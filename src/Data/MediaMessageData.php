<?php

namespace EmizorIpx\ManyContacts\Data;

class MediaMessageData
{
    protected $file;

    protected $text;

    public function __construct(string $file, ?string $text)
    {

        $this->file = $file;

        $this->text = $text;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function toArray()
    {
        return [
            'file' => $this->file,
            'text' => $this->text
        ];
    }
}
