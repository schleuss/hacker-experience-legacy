<?php

require $_SERVER['DOCUMENT_ROOT'].'/classes/Session.class.php';
$session = new Session();

if ($_SERVER['REQUEST_METHOD'] != 'POST' || $session->issetLogin()) {
    header("Location:index.php");
    exit();
}

require $_SERVER['DOCUMENT_ROOT'].'/classes/Database.class.php';

$user = htmlentities($_POST['username']);
$pass = htmlentities($_POST['password']);

$db = new LRSys();

if(isset($_POST['keepalive'])){
    $db->set_keepalive(TRUE);
}

if(!$db->login($user, $pass)){
    $_SESSION['TYP'] = 'LOG';
}

header("Location:login.php");

?>