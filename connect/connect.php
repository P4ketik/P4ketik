<?php 

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect("127.0.0.1", "root", "root", "reg");

    mysqli_query($link,"ALTER TABLE `users` AUTO_INCREMENT = 1");
    mysqli_query($link,"ALTER TABLE `bun_users` AUTO_INCREMENT = 1");
    mysqli_query($link,"ALTER TABLE `posts` AUTO_INCREMENT = 1");
?>