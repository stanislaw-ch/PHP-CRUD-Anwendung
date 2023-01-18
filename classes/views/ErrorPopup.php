<?php
require_once "classes/views/Modules.php";

class ErrorPopup {
    private $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function getContent(): string
    {
        return $this->getMiddle($this->error);
    }

    private function getMiddle($error): string
    {
        return "
                <h2 class='flex items-center justify-center w-full h-10 text-white bg-red-500'>$error</h2>
                ";
    }
}