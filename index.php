<?php

require_once "service/DBApi.php";
require_once "classes/Department.php";
require_once "classes/views/MainPage.php";
require_once "classes/views/DepartmentUpdatePage.php";
require_once "classes/views/EmployeeUpdatePage.php";
require_once "classes/views/EmployeePage.php";
require_once "classes/views/DepartmentPage.php";

$api = new DBApi();

$action = $_REQUEST['action'] ?? '';
$id = $_REQUEST['id'] ?? '';

if (count($_POST) > 1) array_pop($_POST);
$values = $_POST;

$department = new Department($api);
$employee = new Employee($api);

if ($action === 'showUpdateDep'){
    $content = new DepartmentUpdatePage($api, $id);
} elseif ($action === 'deleteDep') {
    $department->delete($id);
    $content = new DepartmentPage($api);
} elseif ($action === 'updateDep') {
    $department->update($values, $id);
    $content = new DepartmentPage($api);
} elseif ($action === 'createDep') {
    $department->create($values);
    $content = new DepartmentPage($api);
} elseif ($action === 'departments') {
    $content = new DepartmentPage($api);
} elseif ($action === 'showUpdateEmp'){
    $content = new EmployeeUpdatePage($api, $id);
} elseif ($action === 'deleteEmp') {
    $employee->delete($id);
    $content = new EmployeePage($api);
} elseif ($action === 'updateEmp') {
    $employee->update($values, $id);
    $content = new EmployeePage($api);
} elseif ($action === 'createEmp') {
    $employee->create($values);
    $content = new EmployeePage($api);
} elseif ($action === 'employees') {
    $content = new EmployeePage($api);
} else {
    $content = new MainPage($api);
}

echo $content->getContent();

