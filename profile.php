<?php 
    require 'connect/connect.php';
    session_start();
    if(!$_SESSION['user']){
        header("location: /index.php");
    }
    $file_name = basename(__FILE__);
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
        require 'components/header.php';
    ?>
    <main class="main">
        
    <?php
        $posts = mysqli_query($link, "SELECT * FROM `posts` WHERE `id_user` = '{$_GET['id_user']}'");
        while($post = mysqli_fetch_assoc($posts)){?>
    <div>
            <?= $post['name'],PHP_EOL   ?>
    </div> 
    
    <div>
            <?= $post['discription'] ?>
    </div>
    
    <?php 
}?>

    </main>
</body>
</html>
<?php
    require 'connect/close-connect.php';
?>