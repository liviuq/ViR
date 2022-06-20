<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: text/xml');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    include_once '../../config/Database.php';
    include_once '../../models/Card.php';
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
    include_once '../../models/Authentication.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Auth object
    $auth = new Authentication($db);

    //define the username
    $username = '';

    //we need to validate jwt from header
    $token = $auth->checkJWTExistance();
    if($token != 1)
    {
        //token found
        if($auth->validateJWT($token) != 0)
        {
            //token not valid
            //validateJWT sends a header

            //die like a hero
            die();
        }
        else
        {
            //valid token
            //cool one liner to decode the JWT
            $obj = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))), true);

            //get the username
            $username = $obj['username'];
        }
    }

    //create the Card object
    $card = new Card($db);

    //Get cards with display format
    $result = $card->read_user_favourites_and_display($username);

    //Getting row count
    $num = $result->rowCount();

    //Check to see if there are any cards
    if($num > 0)
    {
        //there are cards

        //initialize card array
        $cards_arr = array();
        $cards_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $card_item = array(
                'id' => $id,
                'banner' => $banner
            );

            //Push to "data"
            array_push($cards_arr['data'], $card_item);
        }

        //Turn to JSON & output
        header('HTTP/1.1 200 OK');
        echo json_encode($cards_arr);
    }
    else
    {
        //no favs
        header('HTTP/1.1 204 No Content');
        echo json_encode(array(
            'message' => 'No favourite cards found'
        ));
    }

?>