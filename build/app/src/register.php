<?php

require $_SERVER['DOCUMENT_ROOT'].'/classes/Session.class.php';
$session = new Session();

if ($_SERVER['REQUEST_METHOD'] != 'POST' || $session->issetLogin()) {
    
    header("Location:index.php");
    exit();
    
}

require $_SERVER['DOCUMENT_ROOT'].'/classes/Database.class.php';

$regLogin = $_POST['username'];
$regPass = $_POST['password'];
$regEmail = $_POST['email'];

$database = new LRSys();

if ($database->register($regLogin, $regPass, $regEmail)) {

    //Todo: header to email confirmation.

}

$_SESSION['TYP'] = 'REG';

header('Location:index.php');

?>
