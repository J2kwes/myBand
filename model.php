<?php

require_once('db.php');

function make_connection() {
    $mysqli = new mysqli(HOST, USER, PASSWORD, DBC);
    if ($mysqli->connect_errno) {
        die('connection error: ' .$mysqli->connect_errno . '<br>');
    }
    return($mysqli);
}

function get_articles() {
    $mysqli = make_connection();
    $query ="SELECT title FROM  `articles` ";
    $stmt = $mysqli->prepare($query) or die ("error preparing 1.");
    $stmt->bind_result($title) or die ('error binding results 1.');
    $stmt->execute() or die('error executing 1.');
    $results = array();
    while ($stmt->fetch()) {
        $results[] = $title;
    }
    return $results;
}

function get_some_articles() {
    global $pageno;
    $mysqli = make_connection();
    $number_of_pages = calculate_pages() or die ('Error calculating.');
    $firstrow = ($pageno -1) * ARTICLES_PER_PAGE;
    $per_page = ARTICLES_PER_PAGE;
    $query = "SELECT title, content, imagelink FROM articles ORDER BY article_id DESC LIMIT $firstrow, $per_page";
    $stmt = $mysqli->prepare($query) or die ("error preparing 2.");
    $stmt->bind_result($title, $content, $imagelink) or die ('error binding results 3.');
    $stmt->execute() or die('error executing 3.');
    while ($stmt->fetch()) {
        $article = array();
        $article[] = $title;
        $article[] = $content;
        $article[] = $imagelink;
        $results[] = $article;
    }

    return $results;
}

function get_number_of_pages() {
    $number_of_pages = calculate_pages() or die ('Error calculating.');
    return $number_of_pages;
}

function calculate_pages() {
    $mysqli = make_connection();
    $query = "SELECT * FROM articles";
    $result = $mysqli->query($query) or die ('Error querying.2');
    $rows = $result->num_rows;
    $number_of_pages = ceil($rows / ARTICLES_PER_PAGE);
    return $number_of_pages;
}

function register_user(){
$mysqli = make_connection();
    if ($mysqli->connect_errno) {
        echo 'Connection error: ' . $mysqli->connect_errno;
    }

// USERNAME ALREADY IN USE?

    $query = "SELECT userid FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $username = $_POST['username'];
    $stmt->bind_param('s', $username);
    $result = $stmt->execute() or die('Error querying NR.17');
    $row = $stmt->fetch();
    if ($row){
        echo 'USERNAME ALREADY IN USE';
        exit();
    }

// MAIL ADRESS ALREADY IN USE?

    $query = "SELECT userid FROM users WHERE mailadres = ?";
    $stmt = $mysqli->prepare($query);
    $mailadres = $_POST['email'];
    $stmt->bind_param('s', $mailadres);
    $result = $stmt->execute() or die('Error querying NR.30');
    $row = $stmt->fetch();
    if ($row){
        echo 'EMAIL ALREADY IN USE';
        exit();
    }

// SENDS USER BACK IF NOT PRESSED BUTTON
    if (!isset($_POST['submit_registration'])){
        header('Location: ../../public/index.php?page=register_user');
        exit();
    }

// EMPTY INPUT FIELDS?
    if (empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password1']) OR empty($_POST['password2'])){
        header('Location: ../../public/index.php?page=register_user');
        exit();
    }

// PASSWORDS CHECK
    if ($_POST['password1'] != $_POST['password2']){
        header('Location: ../../public/index.php?page=register_user');
        exit();
    }


// ADDING USER TO DATABASE
    $random_number = rand(0,1000000);
    $hash = hash('sha512', $random_number);
    $password = hash('sha512', $_POST['password1']);

    $query = "INSERT INTO users VALUES (0,?,?,?,?,NOW(),0)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssss',$username, $mailadres, $hash, $password);

    $username = $_POST['username'];
    $email = $_POST['email'];

    $result = $stmt->execute() or die ('Error inserting user');
}

function login_user(){
    $mysqli = make_connection();

    $query = "SELECT userid, hash, active FROM users WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($query) or die ('Error preparing NR 101');
    $stmt->bind_param('ss', $username, $password) or die ('Error binding params NR 102');
    $stmt->bind_result($userid, $hash, $active) or die ('Error NR. 103');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha512',$password) or die ('Error hashing NR. 107');
    $stmt->execute() or die ('Error executing STMT NR. 108');
    $stmt->fetch();



    setcookie('userid', $userid, time() + 3600 * 24 * 7, '/');
    setcookie('hash', $hash, time() + 3600 * 24 * 7, '/');
    setcookie('username', $username, time() + 3600 * 24 * 7,'/');
    header('Location: ../public/index.php?page=home');
}