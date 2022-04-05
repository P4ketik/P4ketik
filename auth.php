<?php 
    require 'connect/connect.php';
    session_start();
    if($_SESSION['user']){
        if($_SESSION['user']['flag'] == 1){
            header("location: /profile.php?id-user=".$_SESSION['user']['id']);
        }else{
            header("location: /profile.php?id-user=".$_SESSION['user']['id']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        
        if(!$_SESSION['user']){
    ?>
    <form class="form-reg" action="action/action.php" method="POST">
        <span class="label">Логин:</span>
        <input type="text" name="login" required>

        <span class="label">Email:</span>
        <input type="email" name="email" required>

        <span class="label">Пароль:</span>
        <input type="password" name="pass" required>

        <span class="label">Повторите пароль:</span>
        <input type="password" name="pass1" required>

        <input type="submit" value="Регистрация" name="signup">
        <span class="label">
        <?php
            if ($_SESSION['error']){
                echo $_SESSION['error']['pass'] . '<br>' . $_SESSION['error']['login'] . '<br>' . $_SESSION['error']['email'] . '<br>' . $_SESSION['error']['null']; 
            }          
        ?>
        </span>
    </form>



    <form class="form-reg" action="action/action.php" method="POST">
        <span class="label">Логин или Email:</span>
        <input type="text" name="login" required>

        <span class="label">Пароль:</span>
        <input type="password" name="pass" required>

        <input type="submit" value="Авторизация" name="signin">

        <span class="label">
        <?php
            if ($_SESSION['error']){
                echo $_SESSION['error']['bun'];
            }   
            session_unset();        
        ?>
        </span>
    </form>


    <?php 
        }else{
    ?>
    <span class="label">Привет, <?= $_SESSION['user']['login']; ?>. Нажми, чтобы <a href="action/action.php?logout=">выйти</a></span>
    <?php 
        }
    ?>
</body>
</html>
<?php
    require 'connect/close-connect.php';
?>