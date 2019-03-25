<?php

namespace App\Exception;

use \Exception;

class NoResulutionException extends Exception
{

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}