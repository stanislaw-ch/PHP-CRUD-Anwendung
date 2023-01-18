<?php

require_once "service/DBApi.php";
require_once "classes/Department.php";
require_once "classes/views/MainPage.php";
require_once "classes/views/EmployeePage.php";
require_once "classes/views/DepartmentPage.php";
require_once "utils.php";

$api = new DBApi();

$action = $_REQUEST['action'] ?? '';
$id = $_REQUEST['id'] ?? '';

$errors = [];

if (count($_POST) > 1) array_pop($_POST);
$values = $_POST;

$department = new Department($api);
$employee = new Employee($api);

if ($action === 'showUpdateDep'){
    $content = new DepartmentPage($api, $errors, $id);
} elseif ($action === 'deleteDep') {
    $department->delete($id);
    $content = new DepartmentPage($api);
} elseif ($action === 'updateDep') {
    [$values, $errors] = isValid($values, $errors);

    if (empty($errors)) {
        $department->update($values, $id);
        $content = new DepartmentPage($api);
    } else {
        $content = new DepartmentPage($api, $errors, $id, $values);
    }
} elseif ($action === 'createDep') {
    [$values, $errors] = isValid($values, $errors);

    if (empty($errors)) {
        $department->create($values);
        $content = new DepartmentPage($api);
    } else {
        $content = new DepartmentPage($api, $errors, $id, $values);
    }
} elseif ($action === 'departments') {
    $content = new DepartmentPage($api);
} elseif ($action === 'showUpdateEmp'){
    $content = new EmployeePage($api, $errors, $id);
} elseif ($action === 'deleteEmp') {
    $employee->delete($id);
    $content = new EmployeePage($api);
} elseif ($action === 'updateEmp') {
    [$values, $errors] = isValid($values, $errors);

    if (empty($errors)) {
        $employee->update($values, $id);
        $content = new EmployeePage($api);
    } else {
        $content = new EmployeePage($api, $errors, $id, $values);
    }
} elseif ($action === 'createEmp') {
    [$values, $errors] = isValid($values, $errors);

    if (empty($errors)) {
        $employee->create($values);
        $content = new EmployeePage($api);
    } else {
        $content = new EmployeePage($api, $errors, $id, $values);
    }
} elseif ($action === 'employees') {
    $content = new EmployeePage($api);
} else {
    $content = new MainPage($api);
}

echo $content->getContent();

