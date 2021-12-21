<?php

function checkUser(PDO $dbcon, $username, $passwd)
{
    try {
        $sql = "SELECT password FROM user WHERE username=?";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username));

        $rows = $prepare->fetchAll();

        foreach ($rows as $row) {
            $pw = $row["password"];
            if (password_verify($passwd, $pw)) {
                return true;
            }
        }
        return false;
    } catch (PDOException $e) {
        echo '<br>' . $e->getMessage();
    }
}


function createUser(PDO $dbcon, $username, $passwd)
{
    try {
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT IGNORE INTO user VALUES (?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username, $hash_pw));
    } catch (PDOException $e) {
        echo '<br>' . $e->getMessage();
    }
}

// Luo ja palauttaa tietokantayhteyden.
function getDbConnection()
{
    try {
        $dbcon = new PDO('mysql:host=localhost;dbname=n0reju00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $dbcon;
}
