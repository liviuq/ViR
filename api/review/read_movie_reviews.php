<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Review.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate movie object
    $review = new Review($db);

    //Movie query
    $result = $review->read();

    //Getting row count
    $num = $result->rowCount();

     //Check to see if there are any movies
     if($num > 0)
     {
         //there are movies
 
         //Initialize movie array
         $review_arr = array();
         //Just in case we want to send more things down the lane
         //I added the movies JSON to the field called 'data'
         $review_arr['data'] = array();
 
         while($row = $result->fetch(PDO::FETCH_ASSOC))
         {
             extract($row);
 
             $review_item = array(
                 'id' => $id,
                 'user_id' => $user_id,
                 'movie_id' => $movie_id,
                 'body' => html_entity_decode($body),
                 'rating' => $rating,
                 'created_at' => $created_at
             );
 
             //Push to "data"
             array_push($review_arr['data'], $review_item);
         }
 
         //Turn to JSON & output
         echo json_encode($review_arr);
     }
     else
     {
         //no movies
         echo json_encode(array(
             'message' => 'No reviews found'
         ));
     }
?>