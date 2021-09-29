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

    <form action="includes/signup.php" method="post" enctype="multipart/form-data">
        <label>ФИО</label>
        <input type="text" name="full_name" placeholder="Введите своё полное имя">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Придуймате логин">
        <label>Почта</label>
        <input type="email" name="email" placeholder="Введите свой адрес электронной почты">
        <label>Изображение профиля</label>
        <input type="file" name="avatar">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Придумайте пароль">
        <label>Подтвердение пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <button type="submit">Зарегистрироваться</button>
        <p>
            Уже есть аккаунт?  <a href="/auth.php">Авторизируйтесь</a>!
        </p>
        <?php
            if($_SESSION['message']) {
                 echo '<p class="message">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
        ?>

    </form>

</body>
</html>