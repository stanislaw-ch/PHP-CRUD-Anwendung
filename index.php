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

$router = new Router();

$router->get('/', MainPage::class . '::getContent');
$router->get('/employees', EmployeePage::class . '::execute');
$router->post('/employees', EmployeePage::class . '::execute');
$router->get('/departments', DepartmentPage::class . '::execute');
$router->post('/departments', DepartmentPage::class . '::execute');
$router->addNotFoundHandler(NotFoundPage::class . '::getContent');

$router->run();
