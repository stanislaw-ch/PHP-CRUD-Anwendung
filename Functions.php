<?php
require_once "classes/database_class.php";
require_once "lib/manage_class.php";
require_once "lib/admin_editarticle_class.php";
require_once "lib/admin_addarticlecontent_class.php";
require_once "lib/admin_editabout_class.php";
require_once "lib/admin_editnews_class.php";

$db = new DataBase();

$article = new EditArticle ($db);
$add_article = new AddArticleContent ($db);

$manage = new Manage ($db);
$departmentId = $_REQUEST['id'] ?? '';

if ($_POST["back_add_article"]){
    $r = $add_article->backArticle();
} else exit;

$action = $_REQUEST['action'] ?? 'showMain';

if ($action === 'showUpdate'){
    $r = $add_article->backArticle();
} else exit;


//$manage->redirect($r);

