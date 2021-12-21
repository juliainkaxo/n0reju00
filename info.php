<?php
session_start();

require('functions.php');
require('headers.php');

function selectAsJson($dbcon, $sql)
{
    $query = $dbcon->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}


if (isset($_SESSION['user'])) {
    if (checkUser(getDbConnection(), $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
        $username = $_SERVER['PHP_AUTH_USER'];
    try {
        $db = getDbConnection();
        selectAsJson($db, "select * from personal where username='$username'");
    } catch (PDOException) {
        exit;
    }
} else {
    echo '{"info":"Kirjautuminen epäonnistui"}';
    header('HTTP/1.1 401');
    exit;
}
}