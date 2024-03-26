<?php
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    /*
    API:
        GET:    http://localhost/pizzabackend/index.php?pizza       -- minden pizza (lekérdezés)
        GET:    http://localhost/pizzabackend/index.php?pizza/{id}  -- adott pizza (lekérdezés)
        POST:   http://localhost/pizzabackend/index.php?pizza       -- pizza felvitele
        PUT:    http://localhost/pizzabackend/index.php?pizza/{id}  -- adott pizza módosítása
        DELETE: http://localhost/pizzabackend/index.php?pizza/{id}  -- adott pizza törlése
    */

    //Az URL-ben szereplő kérés feldolgozása
    $urlSzoveg = explode('/', $_SERVER['QUERY_STRING']);
    if ($urlSzoveg[0] === "pizza") {        //Ha az első rész 'pizza'
        require_once 'pizza/tartalom.php';  //Akkor betöltjük a 'pizza' részt
    } else {
        http_response_code(404);    //Ha a kérés nem megfelelő. akkor 'Not Found'
        $errorJson = array("error_message" => 'Nincs ilyen API');   //Hibaüzenet Json-ben
        return json_encode($errorJson); //Json visszaadása
    }