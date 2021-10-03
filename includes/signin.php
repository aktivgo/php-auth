<?php
session_start();
require_once 'database/connect.php';
global $dbh;
require_once '../assets/constants.php';
require_once 'App.php';

$login = $_POST['login'];
$password = $_POST['password'];

$errorFields = [];
if ($login === '') {
    $errorFields[] = 'login';
}
if ($password === '') {
    $errorFields[] = 'password';
}

if (!empty($errorFields)) {
    $response = [
        'status' => false,
        'type' => ERROR_LOGIN_EXIST,
        'message' => "Проверьте правильность полей",
        'fields' => $errorFields
    ];
    echo json_encode($response);
    die();
}

$password = md5($password);

$user = App::LoadData($dbh, SELECT_USER, ['login' => $login]);
if($user == false) {
    $response = [
        'status' => false,
        'message' => 'Неверный логин или пароль'
    ];
    echo json_encode($response);
    die();
}

$_SESSION['user'] = [
    'id' => $user['id'],
    'fullName' => $user['fullName'],
    'email' => $user['email'],
    'avatar' => $user['avatar']
];

$response = [
    'status' => true
];
echo json_encode($response);