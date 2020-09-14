<?php

namespace Codemash\Exceptions;

class RequestValidationException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 400);
    }
}
