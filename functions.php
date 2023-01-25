<?php

$action = $_GET['action'] ?? '';
$view = $_REQUEST['view'] ?? '';
//$id = $_GET(['id']) ?? '';
$department = new Department();

switch ($action) {
    case 'create' . ucfirst(rtrim($view, 's')):
//        [$values, $errors] = isValid($values, $errors);
//
//        if (empty($errors)) {// TODO: check if exists
//            $object->create($values);
//            return new $objectPage($api);
//        } else {
//            return new $objectPage($api, $errors, $id, $values);
//        }
    case 'deleteDepartments':
            echo $action;
//        $department->delete($id);// TODO: check if exists
//        return new $objectPage($api);
    case 'update' . ucfirst(rtrim($view, 's')):
//        [$values, $errors] = isValid($values, $errors);
//
//        if (empty($errors)) {// TODO: check if exists
//            $object->update($values, $id);
//            return new $objectPage($api);
//        } else {
//            return new $objectPage($api, $errors, $id, $values);
//        }
    case 'showUpdate' . ucfirst(rtrim($view, 's')):
//        return new $objectPage($api, $errors, $id);
    case $view:
//        return new $objectPage($api);
}

