<?php

//DATA OPHALEN EN EEN VIEW IN BEELD TOEVOEGEN

function homepage_action() {
    global $smarty;
    $smarty->display('header.tpl');
    $smarty->display('home.tpl');
    $smarty->display('footer.tpl');
}

function admin_action() {
    global $smarty;
    $smarty->display('header.tpl');
    $smarty->display('adminpage.tpl');
    $smarty->display('footer.tpl');
}

function log_in_action() {
    global $smarty;
    $smarty->display('header.tpl');
    $smarty->display('login.tpl');
    $smarty->display('footer.tpl');
}

function reg_action() {
    global $smarty;
    $smarty->display('header.tpl');
    $smarty->display('register.tpl');
    $smarty->display('footer.tpl');
}

function newspage_action() {
    global $smarty;
    global $number_of_pages;
    global $pageno;
    // model
    $articles = get_some_articles();
    $number_of_pages = get_number_of_pages();
    $smarty->assign('current_page', $pageno);
    $smarty->assign('number_of_pages', $number_of_pages);
    $smarty->assign('articles', $articles);
    //views
    $smarty->display('header.tpl');
    $smarty->display('news.tpl');
    $smarty->display('footer.tpl');
}

function contact_action() {
    global $smarty;
    // model

    //views
    $smarty->display('header.tpl');
    $smarty->display('contact.tpl');
    $smarty->display('footer.tpl');
}

function page_not_found_action() {
    global $smarty;
    $smarty->display('notfound.tpl');
}

function register_action(){
    register_user();
}

function login_action(){
    login_user();
}
