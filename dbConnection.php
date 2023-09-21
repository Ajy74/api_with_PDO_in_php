<?php

    $server ="localhost";
    $user ="root";
    $password ="";
    $db ="gita";

    $dbcon = new PDO("mysql:host=$server; dbname=$db",$user,$password);

    $dbcon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

?>