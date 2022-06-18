<?php
    //headers
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Movie.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Movie object
    $movie = new Movie($db);

    //movie query
    $result = $movie->csv();
    if($result == false){
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array(
            'message' => 'Internal Server Error'
        ));
        die();
    }
    //Getting row count
    $num = $result->rowCount();

    //Check to see if there are any entries
    if($num > 0)
    {
        

        //Initialize entries array
        $entries_arr = array();
        //Just in case we want to send more things down the lane
        //I added the cards JSON to the field called 'data'
        $entries_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $entry_item = array(
                'title' => $title,
                'rating' => $rating,
                'status' => $status,
                'aired' => $aired,
                'genre' => $genre
            );

            //Push to "data"
            array_push($entries_arr['data'], $entry_item);
        }

        //Turn to JSON & output
        echo json_encode($entries_arr);
    }
    else
    {
        //no entries
        echo json_encode(array(
            'message' => 'No entries found'
        ));
    }
?>