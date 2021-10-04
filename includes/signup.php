<?php
session_start();
require_once 'database/connect.php';
global $dbh;
require_once '../assets/constants.php';
require_once 'App.php';

$fullName = $_POST['fullName'];
$login = $_POST['login'];
$email = $_POST['email'];
$path = null;
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];

$user = App::LoadData($dbh, SELECT_LOGIN, ['login' => $login]);
if ($user) {
    $response = [
        'status' => false,
        'type' => ERROR_LOGIN_EXIST,
        'message' => 'Такой логин уже существует',
        'fields' => ['login']
    ];
    echo json_encode($response);
    die();
}

$errorFields = [];
if ($fullName === '') {
    $errorFields[] = 'fullName';
}
if ($login === '') {
    $errorFields[] = 'login';
}
if ($email != '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorFields[] = 'email';
}
if ($password === '') {
    $errorFields[] = 'password';
}
if ($passwordConfirm === '') {
    $errorFields[] = 'passwordConfirm';
}

if (!empty($errorFields)) {
    $response = [
        'status' => false,
        'type' => ERROR_LOGIN_EXIST,
        'message' => 'Проверьте правильность полей',
        'fields' => $errorFields
    ];
    echo json_encode($response);
    die();
}

if ($password != $passwordConfirm) {
    $response = [
        'status' => false,
        'message' => 'Пароли не совпадают',
    ];
    echo json_encode($response);
    die();
}

if (isset($_FILES['avatar'])) {
    $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $response = [
            'status' => false,
            'type' => ERROR_IMAGE_LOAD,
            'message' => 'Ошибка при загрузке изображения',
        ];
        echo json_encode($response);
        die();
    }
}

$password = md5($password);

App::SaveData($dbh, INSERT_USER, [
    'fullName' => $fullName,
    'login' => $login,
    'email' => $email,
    'path' => $path,
    'password' => $password,
]);

$response = [
    'status' => true,
    'message' => 'Регистрация прошла успешно!',
];
echo json_encode($response);