<?php

require ('../private/smarty/Smarty.class.php');
require ('../private/model.php');
require ('../private/controller.php');

$smarty = new Smarty();
$smarty->setCompileDir('../private/tmp');
$smarty->setTemplateDir('../private/views');

define('ARTICLES_PER_PAGE', 3);

if (isset($_POST['submit_registration'])){
    register_action();
}

if (isset($_POST['login_user'])){
    login_action();
}

//TERNARY OPERATOR
$page = isset($_GET['page']) ? $page = $_GET['page'] : 'home';
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : '1';

switch ($page) {
    case 'home' : homepage_action(); break;
    case 'news' : newspage_action();break;
    case 'contact' : contact_action(); break;
    case 'register' : reg_action(); break;
    case 'login' : log_in_action(); break;
    case 'admin' : admin_action(); break;
    default : page_not_found_action(); break;
}



