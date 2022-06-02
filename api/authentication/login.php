<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
    include_once '../../config/Database.php';
    include_once '../../models/Authentication.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Auth object
    $auth = new Authentication($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set the username and password for the auth object
    $auth->set_username($data->username);
    $auth->set_password($data->password);

    $result = $auth->processRequest();
?>