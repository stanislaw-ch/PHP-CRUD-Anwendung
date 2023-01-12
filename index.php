<?php
//echo '<link href="assets/css/main.css" rel="stylesheet">';
echo '<body class="bg-gray-200 m-4"></body>';
echo '<script src="https://cdn.tailwindcss.com"></script>';

require_once "service/DBApi.php";
include_once "classes/Department.php";

$api = new DBApi();

$action = $_REQUEST['action'] ?? 'showMain';
$departmentId = $_REQUEST['id'] ?? '';
$name= $_POST['name'] ?? '';

$view = $action;
$department = new Department($api);

if ($action === 'create') {
    $department->create($name);

    $html = $department->getTable();
    $view = 'showMain';
} elseif ($action === 'delete') {
    $department->delete($departmentId);
    $html = $department->getTable();
    $view = 'showMain';
} elseif ($action === 'showUpdate') {
    $department = $department->getById($departmentId);
} elseif ($action === 'update') {
    $department->update($name, $departmentId);
    $view = 'showMain';
}

include 'views/' . $view . '.php';
