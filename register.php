<?php
require_once 'functions.php';
require_once 'headers.php';

//Ottaa vastaan input input tiedot json muodossa
$json = json_decode(file_get_contents('php://input'));

$username = filter_var($json->username, FILTER_SANITIZE_STRING);
$passwd = filter_var($json->passwd, FILTER_SANITIZE_STRING);

//salasanan salaus
$passwd_hash = password_hash($passwd, PASSWORD_DEFAULT);

$db = null;

try {

    $db = getDbConnection();

    $sql = $db->prepare('INSERT INTO `user`(username, password) VALUES (:username, :passwd)');
    $sql->bindValue(':username', $username);
    $sql->bindValue(':passwd', $passwd_hash);
    $sql->execute();

    header('HTTP/1.1 200 OK');
    $data = array('username' => $username, 'password' => $passwd_hash);
    print json_encode($data);
} catch (PDOException) {
    exit;
}