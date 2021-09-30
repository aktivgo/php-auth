<?php
    session_start();

    if($_SESSION['user']){
        header('Location: profile.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <!-- Registration Form -->

    <form>
        <label>
            ФИО или ник
            <label style="color: #AA4345">*</label>
        </label>
        <input type="text" name="full_name" placeholder="Введите своё имя или придумайте ник">
        <label>
            Логин
            <label style="color: #AA4345">*</label>
        </label>
        <input type="text" name="login" placeholder="Придумайте логин">
        <label>Почта</label>
        <input type="email" name="email" placeholder="Введите свой адрес электронной почты">
        <label>Изображение профиля</label>
        <input type="file" name="avatar">
        <label>
            Пароль
            <label style="color: #AA4345">*</label>
        </label>
        <input type="password" name="password" placeholder="Придумайте пароль">
        <label>
            Подтверждение пароля
            <label style="color: #AA4345">*</label>
        </label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <p class="required_fields">
            <label style="color:#AA4345;">
                *
            </label>
            - обязательное поле
        </p>
        <button type="submit" class="register-btn">Зарегистрироваться</button>
        <p>
            Уже есть аккаунт?  <a href="auth.php">Авторизируйтесь!</a>
        </p>
        <p class="message none"></p>

    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>