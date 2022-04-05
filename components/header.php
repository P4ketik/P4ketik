<header class="header" id="header">
    <section class="menu">
        <ul class="main-menu">
            <li class="main-menu-li <?php if ($file_name == "profile.php"){ echo 'active';} ?>">
                <a class="link-full" href="profile.php?id_user=<?=$_SESSION['user']['id']?>">Профиль</a>
            </li>
            <li class="main-menu-li <?php if ($file_name == "post.php"){ echo 'active';} ?>">
                <a class="link-full" href="post.php?id_user=<?=$_SESSION['user']['id']?>">Сделать пост</a>
            </li>
        </ul>
       

    </section>
    <section class="profile">
    <?= $_SESSION['user']['login']; ?><a href="action/action.php?logout=" class="a-none">(выйти)</a>
    </section>
    
</header>