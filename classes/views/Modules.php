<?php
require_once "classes/Department.php";
require_once "classes/Employee.php";

abstract class Modules {
    protected Department $department;
    protected Employee $employee;
    protected string $isActiveMain;
    protected string $isActiveEmployee;
    protected string $isActiveDepartment;
    protected string $activeClass;

    public function __construct($api){
        $this->department = new Department($api);
        $this->employee = new Employee($api);

        $this->activeClass = 'border-b-2 border-black';

        $this->isActiveMain = $this->activeClass;
        $this->isActiveEmployee = '';
        $this->isActiveDepartment = '';

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
            <body class="bg-gray-200 flex flex-col min-h-screen">
        ';
    }

    abstract protected function getTitle();
    abstract protected function getTop();
    abstract protected function getMiddle();

    protected function getFooter(): string
    {
        return '
            <footer class="flex flex-col bg-white h-24 mt-auto justify-center">
                <h2 class="self-center">CRUD-Anwendung</h2>
                <a href="#" class="self-center hover:underline hover:underline-offset-4">Github</a>
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
                     <li>
                        <a 
                            href="?action"
                            class="
                                py-3.5 px-6 inline-block
                                hover:bg-gray-300 font-medium 
                                ' . $this->isActiveMain . '
                            "
                        >
                        Home
                        </a>
                    </li>
                    <li>
                        <a 
                            href="?action=employees"
                            class="
                                py-3.5 px-6 inline-block
                                hover:bg-gray-300 font-medium 
                                ' . $this->isActiveEmployee . '
                            "
                        >
                        Mitarbeiter
                        </a>
                    </li>
                    <li>
                        <a 
                            href="?action=departments"
                            class="
                                py-3.5 px-6 inline-block
                                hover:bg-gray-300 font-medium 
                                    ' . $this->isActiveDepartment . '
                            "
                        >
                        Abteilungen
                        </a>
                    </li>
                  </ul>
                </div>
          </nav>
        ';
    }
}

