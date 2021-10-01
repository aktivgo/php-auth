<?php
    session_start();
    require_once  'Database/connect.php';

    $data = [
        'full_name' => $_POST['full_name'],
        'login' => $_POST['login'],
        'email' => $_POST['email'],
        'path' => NULL,
        'password' => $_POST['password'],
    ];
    $password_confirm = $_POST['password_confirm'];


    $check_login = checkLogin();

    if($check_login) {
        $response = [
            'status' => false,
            'type' => 1,
            'message' => 'Такой логин уже существует',
            'fields' => ['login']
        ];
        echo json_encode($response);
        die();
    }

    $error_fields = [];
    if($data['full_name'] === ''){
        $error_fields[] = 'full_name';
    }
    if($data['login'] === ''){
        $error_fields[] = 'login';
    }
    if($data['email'] != '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        $error_fields[] = 'email';
    }
    if($data['password'] === ''){
        $error_fields[] = 'password';
    }
    if($data['password_confirm'] === ''){
        $error_fields[] = 'password_confirm';
    }

    if(!empty($error_fields)){
        $response = [
            'status' => false,
            'type' => 1,
            'message' => 'Проверьте правильность полей',
            'fields' => $error_fields
        ];
        echo json_encode($response);

        die();
    }

    if($data['password'] === $password_confirm) {
        if ($_FILES['avatar']['name']) {
            $path = 'uploads/' . time() . $_FILES['avatar']['name'];
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
                $response = [
                    'status' => false,
                    'type' => 2,
                    'message' => 'Ошибка при загрузке изображения',
                ];
                echo json_encode($response);
            }
            $data['path'] = $path;
        }

        $data['password'] = md5($data['password']);

        setData();

        $response = [
            'status' => true,
            'message' => 'Регистрация прошла успешно!',
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Пароли не совпадают',
        ];
    }
    echo json_encode($response);

    function checkLogin(){
        global $DBH, $data;
        try {
            $STH = $DBH->prepare("SELECT * FROM users WHERE login = ?");
            $STH->execute(array($data['login']));
            return $STH->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    function setData(){
        global $DBH, $data;
        try {
            $STH = $DBH->prepare("INSERT INTO users VALUES (NULL, :full_name, :login, :email, :path, :password)");
            $STH->execute($data);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }

    }