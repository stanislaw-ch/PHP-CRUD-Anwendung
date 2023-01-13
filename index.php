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
$name= $_POST['name'] ?? '';

$employeeValues = [];
$employeeValues[] = $_POST['firstname'] ?? '';
$employeeValues[] = $_POST['lastname'] ?? '';
$employeeValues[] = $_POST['salary'] ?? '';
$employeeValues[] = $_POST['gender'] ?? '';
$employeeValues[] = $_POST['department_id'] ?? '';

//$firstname= $_POST['firstname'] ?? '';
//$lastname= $_POST['lastname'] ?? '';
//$gender= $_POST['gender'] ?? '';
//$salary= $_POST['salary'] ?? '';
//echo $department= $_POST['department_id'] ?? '';

$department = new Department($api);
$employee = new Employee($api);

if ($action === 'showUpdateDep'){
    $content = new DepartmentUpdatePage($api, $id);
} elseif ($action === 'deleteDep') {
    $department->delete($id);
    $content = new DepartmentPage($api);
} elseif ($action === 'updateDep') {
    $department->update($name, $id);
    $content = new DepartmentPage($api);
} elseif ($action === 'createDep') {
    $department->create($name);
    $content = new DepartmentPage($api);
} elseif ($action === 'departments') {
    $content = new DepartmentPage($api);
} elseif ($action === 'showUpdateEmp'){
    $content = new EmployeeUpdatePage($api, $id);
} elseif ($action === 'deleteEmp') {
    $employee->delete($id);
    $content = new EmployeePage($api);
} elseif ($action === 'updateEmp') {
    $employee->updateEmp($employeeValues, $id);
    $content = new EmployeePage($api);
} elseif ($action === 'createEmp') {
    $employee->createEmp($employeeValues);
    $content = new EmployeePage($api);
} elseif ($action === 'employees') {
    $content = new EmployeePage($api);
} else {
    $content = new MainPage($api);
}

echo $content->getContent();
