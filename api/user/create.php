<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate user object
    $user = new User($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $user->email = $data->email;
    $user->username = $data->username;
    $user->password = $data->password;

    //register user
    if($user->register())
    {
        //user registered successfully
        header('HTTP/1.1 200 OK');
        echo json_encode(
            array('message' => 'User registered')
        );
    }
    else
    {
        //User not registered
        header('HTTP/1.1 406 Not Acceptable');
        echo json_encode(
            array('message' => 'User not registered')
        );
    }
?>