<?php

$connect = mysqli_connect('localhost', 'root', '', 'php-auth');

if(!$connect){
    die('Error connect to DataBase');
}