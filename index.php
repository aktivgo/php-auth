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
    <title>Регистрация и авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- Authorization Form -->

<form>
    <button type="submit" formaction="auth.php">Авторизация</button>
    <label for="" style="align-self: center">или</label>
    <button type="submit" formaction="reg.php">Регистрация</button>
</form>

</body>
</html>