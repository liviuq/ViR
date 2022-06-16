<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    include_once '../../config/Database.php';
    include_once '../../models/Favourite.php';
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

    //create the Favourite object
    $fav = new Favourite($db, $username);

    //Get the ID from the URL
    if(isset($_GET['id']))
    {
        $fav->movie_id = $_GET['id'];
    }
    else
    {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(array(
            'message' => 'Movie id not found in URL'
        ));
    }

    //Creating the favourite
    $result = $fav->create();
    if($result == 0)
    {
        //created the fav 
        header('HTTP/1.1 200 OK');
        echo json_encode(array(
            'message' => 'Favourite created'
        ));
    }
    else if($result == 1)
    {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array(
            'message' => 'Favourite couldn\'t be created'
        ));        
    }
    else if($result == 2)
    {
        header('HTTP/1.1 409 Conflict');
        echo json_encode(array(
            'message' => 'Favorite must be added only once'
        ));        
    }
?>