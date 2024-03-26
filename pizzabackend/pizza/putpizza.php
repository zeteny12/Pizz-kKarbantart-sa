<?php
    //Fájl megnyitása olvasásra
    $putdata = fopen("php://input", "r");
    $raw_data = ''; //Nyers adat tárolása

    //A beérkező adatok beolvasása kilobájtonként, sortörés nélkül
    while ($chunk = fread($putdata, 1024)) {
        $raw_data .= $chunk;
    }

    fclose($putdata); //Fájl bezárása

    //Beolvasás és Json dekódolás
    $adatJson = json_decode($raw_data);
    $pazon = $adatJson->pazon;
    $pnev = $adatJson->pnev;
    $par = $adatJson->par;

    //Adatbázis kapcsolatának létrehozása
    require_once './pizzabackend/database.php';

    //SQL adatok előkészítése az adatok frissítéséhez
    $sql = "UPDATE pizza SET pnev=?, par=? WHERE pazon=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sii", $pnev, $par, $pazon);

    //SQL lekérdezés végrehajtása
    if ($stmt->execute()) {
        //Ha sikeres, üzenet és státuszkód visszaadása
        http_response_code(201);
        return json_encode(array("message" => 'Sikeresen módosítva az étlap!'));
    } else {
        //Ha sikertelen, üzenet és státuszkód visszaadása
        http_response_code(404);
        return json_encode(array("message" => 'Sikertelen az étlap módosítása!'));
    }