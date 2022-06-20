<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    include_once '../../config/Database.php';
    include_once '../../models/Movie.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate movie object
    $movie = new Movie($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set the ID  to know which record to delete
    $movie->id = $data->id;

    //Delete post
    if($movie->delete())
    {
        //Movie deleted
        header('HTTP/1.1 200 OK');
        echo json_encode(
            array('message' => 'Movie deleted')
        );
    }
    else
    {
        //Movie not deleted
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(
            array('message' => 'Movie not deleted')
        );
    }
?>
