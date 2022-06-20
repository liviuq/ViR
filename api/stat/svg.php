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
    $result = $movie->svg();
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
                'rating' => $rating,
                'count' => $count
            );

            //Push to "data"
            array_push($entries_arr['data'], $entry_item);
        }

        //Turn to JSON & output
        header('HTTP/1.1 200 OK');
        echo json_encode($entries_arr);
    }
    else
    {
        //no entries
        header('HTTP/1.1 204 No Content');
        echo json_encode(array(
            'message' => 'No entries found'
        ));
    }
?>