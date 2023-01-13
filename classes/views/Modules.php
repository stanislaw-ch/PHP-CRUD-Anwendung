<?php
require_once "classes/Department.php";
require_once "classes/Employee.php";

abstract class Modules {
    protected Department $department;
    protected Employee $employee;

    public function __construct($api){
        $this->department = new Department($api);
        $this->employee = new Employee($api);
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
            <body class="bg-gray-200">
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
        return '
            <nav class="bg-white mb-5">
                <div class="">
                  <ul class="flex justify-center">
                     <li class="
                            py-3.5 px-6 self-center 
                            hover:bg-gray-300 font-medium 
                        "
                     >
                            <a href="?action">Home</a>
                    </li>
                    <li class="
                            py-3.5 px-6 self-center 
                            hover:bg-gray-300 font-medium 
                        "
                    >
                        <a href="?action=employees">Mitarbeiter</a>
                    </li>
                    <li class="
                        py-3.5 px-6 self-center 
                        hover:bg-gray-300 font-medium 
                        "
                    >
                        <a href="?action=departments">Abteilungen</a>
                    </li>
                  </ul>
                </div>
          </nav>
        ';
    }
}

