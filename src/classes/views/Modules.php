<?php

require_once "src/service/DepartmentModel.php";
require_once "src/service/EmployeeModel.php";
require_once "src/service/GenderModel.php";

abstract class Modules
{
    protected DepartmentModel $department;
    protected EmployeeModel $employee;
    protected GenderModel $gender;
    protected string $isActiveMain;
    protected string $isActiveEmployee;
    protected string $isActiveDepartment;
    protected string $activeClass;

    public function __construct()
    {
        $this->department = new DepartmentModel();
        $this->employee = new EmployeeModel();
        $this->gender = new GenderModel();

        $this->activeClass = 'border-b-2 border-black';

        $this->isActiveMain = $this->activeClass;
        $this->isActiveEmployee = '';
        $this->isActiveDepartment = '';
    }

    public function getContent(): void
    {
        $sr["title"] = $this->getTitle();
        $sr["isActiveMain"] = $this->isActiveMain;
        $sr["isActiveEmployee"] = $this->isActiveEmployee;
        $sr["isActiveDepartment"] = $this->isActiveDepartment;
        $sr["middle"] = $this->getMiddle();

        echo $this->getReplaceTemplate($sr, "root");
    }

    abstract protected function getTitle();

    abstract protected function getMiddle();

    protected function isError($errors, $errorName): string
    {
        $html = '';

        if (isset($errors[$errorName])) {
            $html .= '<span class="text-red-600 -mt-4 mb-3">' . $errors[$errorName] . '</span>';
        }

        return $html;
    }

    protected function getTemplate($name): array|bool|string
    {
        return file_get_contents("src/tpl/" . $name . ".tpl");
    }

    protected function getReplaceContent($sr, $content): array|string
    {
        $search = array();
        $replace = array();
        $i = 0;
        foreach ($sr as $key => $value) {
            $search[$i] = "%$key%";
            $replace[$i] = $value;
            $i++;
        }
        return str_replace($search, $replace, $content);
    }

    protected function getReplaceTemplate($sr, $template): array|string
    {
        return $this->getReplaceContent($sr, $this->getTemplate($template));
    }
}

