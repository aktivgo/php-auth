<?php
    session_start();

    if(!$_SESSION['user']){
        header('Location: index.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <!-- Profile -->

    <form style="border-style: solid">
        <img src="<?= $_SESSION['user']['avatar']?>" style="align-self: center" width="200" alt="">
        <h2 style="align-self: center"><?= $_SESSION['user']['full_name']?></h2>
        <a style="align-self: center" href="mailto:<?= $_SESSION['user']['email']?>"><?= $_SESSION['user']['email']?></a>
        <a style="align-self: center" href="includes/logout.php" class="logout">Выход</a>
    </form>

</body>
</html>