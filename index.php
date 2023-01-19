<?php

require_once "service/DBApi.php";
require_once "classes/Department.php";
require_once "classes/views/MainPage.php";
require_once "classes/views/EmployeePage.php";
require_once "classes/views/DepartmentPage.php";
require_once "utils.php";

$api = new DBApi();
$action = $_REQUEST['action'] ?? '';
$view = $_REQUEST['view'] ?? '';
$id = $_REQUEST['id'] ?? '';
$errors = [];
$values = getValuesWithoutID($_POST);
$department = new Department($api);
$employee = new Employee($api);
$content = match ($view) {
    'employees' => getContent(
        $api,
        $action,
        $employee,
        $class = 'EmployeePage',
        'employees',
        $values,
        $errors,
        $id
    ),
    'departments' => getContent(
        $api,
        $action,
        $department,
        $class = 'DepartmentPage',
        'departments',
        $values,
        $errors,
        $id
    ),
    default => new MainPage($api)
};

echo $content->getContent();

