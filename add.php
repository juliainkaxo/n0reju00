<?php
require_once 'functions.php';
require_once 'headers.php';

//Ottaa vastaan input input tiedot json muodossa
$json = json_decode(file_get_contents('php://input'));

$username = filter_var($json->username, FILTER_SANITIZE_STRING);
$fname = filter_var($json->fname, FILTER_SANITIZE_STRING);
$lname = filter_var($json->lname, FILTER_SANITIZE_STRING);

$db = null;

try {

    $db = getDbConnection();

    $sql = $db->prepare('INSERT INTO personal (username, fname, lname) VALUES (:username, :fname, :lname)');
    $sql->bindValue(':username', $username);
    $sql->bindValue(':fname', $fname);
    $sql->bindValue(':lname', $lname);
    $sql->execute();

    header('HTTP/1.1 200 OK');
    $data = array('username' => $username, 'fname', $fname, 'lname', $lname);
    print json_encode($data);
} catch (PDOException) {
    exit;
}
