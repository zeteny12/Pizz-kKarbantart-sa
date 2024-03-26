<?php
    //Utasítás kérése, annak alapján történik a meghívás
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            require_once 'pizza/getpizza.php';
            break;
        
            case 'POST':
                require_once 'pizza/postpizza.php';
                break;

                case 'PUT':
                    require_once 'pizza/putpizza.php';
                    break;

                    case 'DELETE':
                        require_once 'pizza/deletepizza.php';
                        break;
        default:
            break;
    }