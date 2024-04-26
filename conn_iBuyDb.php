<?php
    $server = 'localhost';
    $user = 'root';
    $password = 'password';
    $database = 'ibuydb';
    $link = mysqli_connect($server, $user, $password, $database) or
    die('Error' . mysqli_error($link));
?>