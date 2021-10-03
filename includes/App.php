<?php

require_once 'database/connect.php';
global $dbh;

class App
{
    public static function LoadData ($dbh, $sql, $dataSelect) {
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute($dataSelect);
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public static function SaveData ($dbh, $sql, $dataInsert) {
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute($dataInsert);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}