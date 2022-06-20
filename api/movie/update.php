<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    //Set the ID  to know which record to update
    $movie->id = $data->id;

    $movie->title = $data->title;
    $movie->banner = $data->banner;
    $movie->synopsis = $data->synopsis;
    $movie->rating = $data->rating;
    $movie->actors = $data->actors;
    $movie->director = $data->director;
    $movie->writer = $data->writer;
    $movie->status = $data->status;
    $movie->aired = $data->aired;
    $movie->genre = $data->genre;

    //Update post
    if($movie->update())
    {
        //Movie updated
        header('HTTP/1.1 200 OK');
        echo json_encode(
            array('message' => 'Movie updated')
        );
    }
    else
    {
        //Movie not updated
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(
            array('message' => 'Movie not updated')
        );
    }
?>
