<?php

namespace App\Exception;

use \Exception;

class NoFileException extends Exception
{

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}