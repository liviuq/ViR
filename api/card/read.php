<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Card.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Card object
    $card = new Card($db);

    //Card query
    $result = $card->read();

    //Getting row count
    $num = $result->rowCount();

    //Check to see if there are any cards
    if($num > 0)
    {
        //there are cards

        //Initialize cards array
        $cards_arr = array();
        //Just in case we want to send more things down the lane
        //I added the cards JSON to the field called 'data'
        $cards_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $card_item = array(
                'id' => $id,
                'banner' => $banner,
                'genre_name' => $genre_name,
            );

            //Push to "data"
            array_push($cards_arr['data'], $card_item);
        }

        //Turn to JSON & output
        echo json_encode($cards_arr);
    }
    else
    {
        //no movies
        echo json_encode(array(
            'message' => 'No cards found'
        ));
    }
?>