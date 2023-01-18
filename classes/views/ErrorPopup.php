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
        $html = $this->getMiddle($this->error);
        $html .= $this->getHeader();
        return $html;
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Error page";
    }

    private function getHeader(): string
    {
        return '
            <!doctype html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport"
                      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>'. $this->getTitle() .'</title>
                <script src="https://cdn.tailwindcss.com"></script>
            </head>
            <body class="bg-gray-200 flex flex-col min-h-screen">
        ';
    }

    private function getMiddle($error): string
    {
        return "
                <h2 class='flex items-center justify-center w-full h-10 text-white bg-red-500'>$error</h2>
                ";
    }
}