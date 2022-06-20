<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Review.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate review object
    $review = new Review($db);
    

    //Set review movie id
    //Get the ID from the URL
    $review -> movie_id = isset($_GET['id']) ? $_GET['id'] : die();

    //review query
    $result = $review->read_movie_reviews();

    //Getting row count
    $num = $result->rowCount();

     //Check to see if there are any review
     if($num > 0)
     {
         //there are review
 
         //Initialize review array
         $review_arr = array();
         //Just in case we want to send more things down the lane
         //I added the review JSON to the field called 'data'
         $review_arr['data'] = array();
 
         while($row = $result->fetch(PDO::FETCH_ASSOC))
         {
             extract($row);
 
             $review_item = array(
                 'username' => $username,
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
         header('HTTP/1.1 200 OK');
         echo json_encode($review_arr);
     }
     else
     {
         //no review
         header('HTTP/1.1 204 No Content');
         echo json_encode(array(
             'message' => 'No reviews found'
         ));
     }
?>