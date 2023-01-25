<?php

require_once "src/classes/views/Modules.php";

class ErrorPage
{
    private $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Error page";
    }

    public function getContent(): void
    {
        $html = $this->getHeader();
        $html .= $this->getMiddle($this->error);
        $html .= $this->getFooter();

        echo $html;
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
                <title>' . $this->getTitle() . '</title>
                <script src="https://cdn.tailwindcss.com"></script>
            </head>
            <body class="bg-gray-200 flex flex-col min-h-screen">
        ';
    }

    private function getMiddle($error): string
    {
        return "
                <h2 class='text-center mt-auto text-3xl'>$error</h2>
                ";
    }

    private function getFooter(): string
    {
        return '
            <footer class="flex flex-col bg-white h-24 mt-auto justify-center">
                <h2 class="self-center">CRUD-Anwendung</h2>
                <a href="https://github.com/stanislaw-ch/PHP-CRUD-Anwendung" target=”_blank” class="self-center hover:underline hover:underline-offset-4">GitHub</a>
            </footer>
            <script src="/src/assets/js/main.js"></script>
            </body>
            </html>
        ';

    }
}