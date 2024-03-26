<?php
    $connection = new mysqli("localhost", "root", "", "pizza"); //Csatlakozás az adatbázishoz
    if ($connection->connect_error) {   //Ha hibára fut
        die("Connection failed: " . $connection->connect_error);    //Akkor vége mindennek
    } else {
        $connection->set_charset("utf8");   //Ha csatlakozott, akkor a 'charset'-et beállítjuk 'utf8'-ra
    }