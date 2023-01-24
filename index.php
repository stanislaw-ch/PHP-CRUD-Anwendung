<?php
declare(strict_types=1);

require_once "service/DBApi.php";
require_once "classes/Department.php";
require_once "classes/views/MainPage.php";
require_once "classes/views/EmployeePage.php";
require_once "classes/views/DepartmentPage.php";
require_once "classes/views/ContactPage.php";
require_once "classes/views/NotFoundPage.php";
require_once "router/Router.php";
require_once "utils.php";
require_once "functions.php";

//$api = new DBApi();
//$action = $_REQUEST['action'] ?? '';
//$view = $_REQUEST['view'] ?? '';
//$id = $_REQUEST['id'] ?? '';
//$errors = [];
//$values = getValuesWithoutID($_POST);
//$department = new Department($api);
//$employee = new Employee($api);
//$content = match ($view) {
//    'employees' => getContent(
//        $api,
//        $action,
//        $employee,
//        $class = 'EmployeePage',
//        'employees',
//        $values,
//        $errors,
//        $id
//    ),
//    'departments' => getContent(
//        $api,
//        $action,
//        $department,
//        $class = 'DepartmentPage',
//        'departments',
//        $values,
//        $errors,
//        $id
//    ),
//    default => new MainPage($api)
//};
//
//echo $content->getContent();

$router = new Router();

$router->get('/', MainPage::class . '::getContent');
$router->get('/employees', EmployeePage::class . '::getContent');
$router->get('/departments', DepartmentPage::class . '::getContent');
$router->post('/departments', DepartmentPage::class . '::getContent');
$router->get('/contact', ContactPage::class . '::execute');
$router->post('/contact', ContactPage::class . '::execute');

$router->addNotFoundHandler(NotFoundPage::class . '::getContent');

$router->run();
