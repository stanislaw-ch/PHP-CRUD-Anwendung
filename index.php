<?php
require_once "src/views/MainPage.php";
require_once "src/views/EmployeePage.php";
require_once "src/views/DepartmentPage.php";
require_once "src/views/NotFoundPage.php";
require_once "src/router/Router.php";
require_once "utils.php";

$router = new Router();

$router->get('/', MainPage::class . '::getContent');
$router->get('/employees', EmployeePage::class . '::execute');
$router->post('/employees', EmployeePage::class . '::execute');
$router->get('/departments', DepartmentPage::class . '::execute');
$router->post('/departments', DepartmentPage::class . '::execute');
$router->addNotFoundHandler(NotFoundPage::class . '::getContent');

$router->run();
