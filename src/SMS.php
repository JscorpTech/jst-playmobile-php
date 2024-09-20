<?php

namespace Jscorptech;


class SMS
{
    public $id;
    public $sender;
    public $recipient;
    public $text;

    public function __construct($id, $sender, $recipient, $text)
    {
        $this->id = $id;
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->text = $text;
    }
}