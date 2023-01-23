<?php
require_once "classes/views/Modules.php";

class NotFoundPage {
    public function getTitle(): string
    {
        return "Page not found";
    }

    public function getContent(): void
    {
        $html = $this->getHeader();
        $html .= $this->getMiddle();

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
                <title>'. $this->getTitle() .'</title>
                <script src="https://cdn.tailwindcss.com"></script>
            </head>
            <body class="bg-gray-200 flex justify-center items-center h-screen">
        ';
    }

    private function getMiddle(): string
    {
        return "
                <h2 class='text-center text-3xl'>Page not found</h2>
                ";
    }
}