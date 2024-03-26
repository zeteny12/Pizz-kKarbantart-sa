<?php
    //'POST' kérésből érkező adatok
    $pazon = $_POST['pazon'];
    $pnev = $_POST['pnev'];
    $par = $_POST['par'];

    //Adatbázis kapcsolatának létrehozása
    require_once './pizzabackend/database.php';

    //SQL lekérdezés előkészítése
    $sql = "INSERT INTO pizza (pazon, pnev, par) VALUES (NULL, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $pnev, $par);   //Paraméterek megadása

    //SQL lekérdezés végrehajtása
    if ($stmt->execute()) {
        //Ha sikeres, üzenet és státuszkód visszaadása
        http_response_code(201);
        return json_encode(array("message" => "Sikeresen hozzáadva az étlaphoz!"));
    } else {
        //Ha sikertelen, üzenet és státuszkód visszaadása
        http_response_code(404);
        return json_encode(array("message" => "Sikertelen az étlap feltöltése!"));
    }