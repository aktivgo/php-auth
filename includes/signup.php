<?php
    session_start();
    require_once 'connect.php';
    global $connect;

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if($password === $password_confirm) {

        if($_FILES['avatar']['name']) {
            $path = 'uploads/' . time() . $_FILES['avatar']['name'];
            if(!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
                $_SESSION['message'] = 'Ошибка при загрузке изображения';
                header('Location: ../reg.php');
            }
        }
        else{
            $path = NULL;
        }

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `avatar`, `password`) VALUES (NULL, '$full_name', '$login', '$email', '$path', '$password')");
        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../auth.php');

    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../reg.php');
    }