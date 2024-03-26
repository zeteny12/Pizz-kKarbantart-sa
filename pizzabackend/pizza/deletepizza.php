<?php
    $sql = '';  //SQL utasítás

    //Ha van azonosító a kérédben
    if (count($urlSzoveg) > 1) {
        
        //Ellenőrizzük, hogy szám-e
        if (is_int(intval($urlSzoveg[1]))) {
            //Adott ügyfél törlése
            $sql = 'DELETE FROM pizza WHERE azon=' . $kereSzoveg[1]; 
        }
    } else {    //Ha nincs azonosító
        //Akkor hibakód visszaadása
        http_response_code(404);
        return json_encode(array("message" => "Nincs ilyen pizza az étlapon!"));
    }

    //Adatbázis kapcsolatának létrehozása
    require_once './pizzabackend/database.php';

    //SQL lekérdezés végrehajtása
    if ($result = $connection->query($sql)) {
        //Sikeres törlés esetén közöljük a felhasználóval
        http_response_code(201);
        return json_encode(array("message" => "A pizza sikeresen törölve az étlapról!"));
    } else {
        //Sikertelen törlés esetén közöljük a felhasználóval
        http_response_code(404);
        return json_encode(array("message" => "A pizza törlése sikertelen!"));
    }