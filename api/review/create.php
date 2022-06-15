<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    include_once '../../config/Database.php';
    include_once '../../models/Review.php';
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
    include_once '../../models/Authentication.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Auth object
    $auth = new Authentication($db);

    //Instantiate review object
    $review = new Review($db);

    //Set review movie id
    //Get the ID from the URL
    $review -> movie_id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set the body and rating of the review
    $review->body = $data->body;
    $review->rating = $data->rating;

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

            //create the review
            $review->create($obj['username']);

            //success
            header('HTTP/1.1 200 OK');
                echo json_encode(array(
                    'message' => 'Review posted'
                ));
        }
    }
