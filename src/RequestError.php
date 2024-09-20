<?php

namespace Jscorptech;


class RequestError extends \Exception
{
    public $http_status;
    public $error;

    public function __construct($http_status, $error = null)
    {
        $message = "Playmobile responded with status $http_status.";
        if ($error) {
            $message .= "\nError code: {$error['code']}. Error description: {$error['description']}.";
        }
        parent::__construct($message);
        $this->http_status = $http_status;
        $this->error = $error;
    }
}