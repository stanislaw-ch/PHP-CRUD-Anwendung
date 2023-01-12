<?php

require_once "service/DBApi.php";
include_once "classes/Department.php";
include_once "classes/views/MainPage.php";
include_once "classes/views/UpdatePage.php";

$api = new DBApi();

$action = $_REQUEST['action'] ?? '';
$departmentId = $_REQUEST['id'] ?? '';
$name= $_POST['name'] ?? '';

$department = new Department($api);

if ($action === 'showUpdate'){
    $content = new UpdatePage($api, $departmentId);
} elseif ($action === 'delete') {
    $department->delete($departmentId);
    $content = new MainPage($api);
} elseif ($action === 'update') {
    $department->update($name, $departmentId);
    $content = new MainPage($api);
} elseif ($action === 'create') {
    $department->create($name);
    $content = new MainPage($api);
} else {
    $content = new MainPage($api);
}

echo $content->getContent();
