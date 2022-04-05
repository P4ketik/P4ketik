<?php
    require '../connect/connect.php';
    session_start();

        if(isset($_POST['signup']) && (!empty($_POST['login']) || !empty($_POST['email']) || !empty($_POST['pass']))){
            $login = mysqli_real_escape_string($link, $_POST['login']);
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $check_login = mysqli_query($link, "SELECT * FROM `users` WHERE login='$login'");
            $check_email = mysqli_query($link, "SELECT * FROM `users` WHERE email='$email'");
            if(mysqli_num_rows($check_login)==0 && mysqli_num_rows($check_email)==0 ){
                if($_POST['pass']==$_POST['pass1'] && !(stripos($_POST['login'], '@')) && stripos($_POST['email'], '@')){
                    $pass = md5($_POST['pass'] . 'jsadfg');
        
                    mysqli_query($link, "INSERT INTO `users` (`login`, `email`, `password`) VALUES ('{$_POST['login']}', '$email', '$pass')");

                    $users = mysqli_query($link, "SELECT * FROM `users` WHERE (login='{$_POST['login']}' OR email='{$_POST['login']}') AND password='$pass'");
                    $user = mysqli_fetch_assoc($users);
                    if(mysqli_num_rows($users)>=1){
                        
                        $_SESSION['user'] = [
                            "id" => $user['id'],
                            "login" => $user['login'],
                            "email" => $user['email'],
                            "flag" => $user['flag']
                        ];
                    }
        
                }
                if ($_POST['pass']!==$_POST['pass1']) {
                        $_SESSION['error'] = [
                            "pass" => 'Пароли должны совпадать'
                        ];
                    }
                if ((stripos($_POST['login'], '@'))) {
                            $_SESSION['error'] = [
                                    "login" => 'В логине не должно быть @'
                            ];
                        }
            }else{
                $_SESSION['error'] = [
                        "email" => 'Такой Email или Логин уже существуют'
                ];
            }
        header("location: /index.php");
    }elseif(isset($_POST['signup'])){
        $_SESSION['error'] = [
            "null" => 'Все поля дожны быть заполнены'
        ];
        header("location: /index.php");
    }
    
    
    if(isset($_POST['signin'])){
        $login = mysqli_real_escape_string($link, $_POST['login']);
        $pass = md5($_POST['pass'] . 'jsadfg');
        $users = mysqli_query($link, "SELECT * FROM `users` WHERE (login='$login' OR email='$login') AND password='$pass'");
        $user = mysqli_fetch_assoc($users);
            if(mysqli_num_rows($users)>=1){
                $check_bun= mysqli_query($link, "SELECT * FROM `bun_users` WHERE `id_user`='{$user['id']}'");
                if(mysqli_num_rows($check_bun)==0){
                    $_SESSION['user'] = [
                        "id" => $user['id'],
                        "login" => $user['login'],
                        "email" => $user['email'],
                        "flag" => $user['flag']
                    ];
                }else{
                    $_SESSION['error'] = [
                        "bun" => 'Ваша учетная запись заблокирована администратором'
                    ];
                }
            }
        header("location: /index.php");
    }
    if(isset($_GET['logout'])){
        session_unset();
        header("location: /index.php");
    }



    if(isset($_POST['user-bun'])){
        mysqli_query($link, "INSERT INTO `bun_users` (`id_user`) VALUES ('{$_POST['id']}')");
        header("location: /index.php");
    }
    if(isset($_POST['user-unbun'])){
        mysqli_query($link, "DELETE FROM `bun_users` WHERE `id`='{$_POST['id']}'");
        header("location: /index.php");
    }

    if(isset($_POST['add-new-post'])){
        $date = date('Y-m-d H:i:s');
        mysqli_query($link, "INSERT INTO `posts` (`id_user`, `name`, `date`, `discription`, `file_name`) 
        VALUES ('{$_SESSION['user']['id']}', '{$_POST['name']}', '$date', '{$_POST['discription']}', 'file')");
        $posts = mysqli_query($link, "SELECT * FROM `posts` WHERE (id_user='{$_SESSION['user']['id']}') ORDER BY `id` DESC");
        $post = mysqli_fetch_assoc($posts);
        $file_name = $_SESSION['user']['login'].'-'.$_SESSION['user']['id'].'-'.$post['id'].'.'.substr($_FILES['img']['type'], 6, 10);
        move_uploaded_file($_FILES['img']['tmp_name'],'../files/user-files/'.$file_name);
        mysqli_query($link, "UPDATE `posts` SET `file_name`='$file_name' WHERE `id`='{$post['id']}'");
        header("location: /new-post.php");
    }
    

    require '../connect/close-connect.php';
    header("location: /index.php");
?>