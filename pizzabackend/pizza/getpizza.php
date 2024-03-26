<?php
    $sql = '';  //SQL utasítás

    //Ha a kérésben meg van adva az azonosító
    if (count($urlSzoveg) > 1) {
        
        //Ellenőrizzük, hogy szám-e
        if (is_int(intval($urlSzoveg[1]))) {
            
            //Adott ügyfél lekérdezése
            $sql = 'SELECT * FROM pizza WHERE azon=' . $urlSzoveg[1];
        } else {    //Ha az azonosító nem szám, akkor hibakód
            http_response_code(404);
            return json_encode(array("error message" => "Az étlapon nincs ilyen pizza!"));
        }
    } else {    //Ha nincs azonosító, akkor lekérdezzük az összes ügyfelet
        $sql = 'SELECT * FROM pizza WHERE 1';
    }

    //Adatbázis kapcsolatának létrehozása
    require_once './pizzabackend/database.php';

    //SQL lekérdezés végrehajtása
    $result = $connection->query($sql);

    //Ha vannak eredmények
    if ($result->num_rows > 0) {
        $pizzak = array();  //'pizzak' tömb létrehozása
        
        //Eredmények feldolgozása, tömbbe rendezése
        while ($row = $result->fetch_assoc()) {
            $pizzak[] = $row;
        }
        
        //HTTP státuszkód beállítasa (OK)
        http_response_code(200);
        
        //Pizzák visszaadása Json-ben
        return json_encode($pizzak);
    } else {    //Ha nincsenek eredmények
        //Hibakód visszaadása
        http_response_code(404);
        return json_encode(array("message" => "Nincs pizza az étlapon!"));
    }