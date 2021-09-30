<?php
    session_start();
    require_once 'connect.php';
    global $connect;

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if(mysqli_num_rows($check_login) > 0) {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Такой логин уже существует",
            "fields" => ['login']
        ];
        echo json_encode($response);
        die();
    }

    $error_fields = [];
    if($full_name === ''){
        $error_fields[] = 'full_name';
    }
    if($login === ''){
        $error_fields[] = 'login';
    }
    if($email != '' && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_fields[] = 'email';
    }
    if($password === ''){
        $error_fields[] = 'password';
    }
    if($password_confirm === ''){
        $error_fields[] = 'password_confirm';
    }

    if(!empty($error_fields)){
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Проверьте правильность полей",
            "fields" => $error_fields
        ];
        echo json_encode($response);

        die();
    }

    if($password === $password_confirm) {
        if ($_FILES['avatar']['name']) {
            $path = 'uploads/' . time() . $_FILES['avatar']['name'];
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
                $response = [
                    "status" => false,
                    "type" => 2,
                    "message" => "Ошибка при загрузке изображения",
                ];
                echo json_encode($response);
            }
        } else {
            $path = NULL;
        }

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `avatar`, `password`) VALUES (NULL, '$full_name', '$login', '$email', '$path', '$password')");
        $response = [
            "status" => true,
            "message" => "Регистрация прошла успешно!",
        ];
    } else {
        $response = [
            "status" => false,
            "message" => "Пароли не совпадают",
        ];
    }
    echo json_encode($response);