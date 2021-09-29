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

    <form style="border: solid #AB9DAE; border-radius: 25px; padding: 20px">
        <img src="<?= $_SESSION['user']['avatar']?>" style="align-self: center; margin: 0 0 20px 0" width="200" alt="">
        <h2 style="align-self: center; margin: 0 0 20px 0"><?= $_SESSION['user']['full_name']?></h2>
        <a style="align-self: center; color: #5281A1; margin: 0 0 30px 0"
           href="mailto:<?= $_SESSION['user']['email']?>" class="email_profile"><?= $_SESSION['user']['email']?></a>
        <a style="align-self: center" href="includes/logout.php" class="logout">
            <h2>Выход</h2>
        </a>
    </form>

</body>
</html>