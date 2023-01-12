<?php
require_once "classes/Department.php";

abstract class Modules {
    protected Department $department;

    public function __construct($api){
        $this->department = new Department($api);
    }

    public function getContent(): string
    {
        $html = $this->getHeader();
        $html .= $this->getMenu();
        $html .= $this->getTop();
        $html .= $this->getMiddle();
        $html .= $this->getFooter();

        return $html;
    }

    protected function getHeader(): string
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
            <body class="bg-gray-200 m-4">
        ';
    }

    abstract protected function getTitle();
    abstract protected function getTop();
    abstract protected function getMiddle();

    protected function getFooter(): string
    {
        return '
            <footer>
            
            </footer>
            <script src="/assets/js/department.js"></script>
            </body>
            </html>
        ';

    }

    protected function getMenu(): string
    {
        $text = '';
//        $menu = $this->menu->getAll();
//        for ($i = 0; $i < count($menu); $i++){
//            $sr["title"] = $menu[$i]["title"];
//            $sr["link"] = $menu[$i]["link"];
//            $sr["style"] = $menu[$i]["style"];
//            $text .= $this->getReplaceTemplate($sr, "menu_item");
//
//        }
        return $text;
    }
}

