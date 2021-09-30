<?php
    session_start();
    require_once  'Database/connect.php';

    $data = [
        'login' => $_POST['login'],
        'password' => $_POST['password']
    ];

    $error_fields = [];
    if($data['login'] === ''){
        $error_fields[] = 'login';
    }
    if($data['password'] === ''){
        $error_fields[] = 'password';
    }

    if(!empty($error_fields)){
        $response = [
            'status' => false,
            'type' => 1,
            'message' => "Проверьте правильность полей",
            'fields' => $error_fields
        ];
        echo json_encode($response);

        die();
    }

    $data['password'] = md5($_POST['password']);

    $user = checkUser();
    if($user) {

        $_SESSION['user'] = [
            "id" => $user['id'],
            "full_name" => $user['full_name'],
            "email" => $user['email'],
            "avatar" => $user['avatar']
        ];

        $response = [
            "status" => true
        ];

    } else {
        $response = [
            "status" => false,
            "message" => 'Неверный логин или пароль'
        ];
    }
    echo json_encode($response);

    function checkUser(){
        global $DBH, $data;
        $STH = $DBH->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
        $STH->execute($data);
        return $STH->fetch(PDO::FETCH_ASSOC);
    }