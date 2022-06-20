<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Movie.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate movie object
    $movie = new Movie($db);

    //Movie query
    $result = $movie->read();

    //Getting row count
    $num = $result->rowCount();

    //Check to see if there are any movies
    if($num > 0)
    {
        //there are movies

        //Initialize movie array
        $movies_arr = array();
        //Just in case we want to send more things down the lane
        //I added the movies JSON to the field called 'data'
        $movies_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $movie_item = array(
                'id' => $id,
                'title' => $title,
                'banner' => $banner,
                'synopsis' => html_entity_decode($synopsis),
                'rating' => $rating,
                'actors' => $actors,
                'director' => $director,
                'writer' => $writer,
                'status' => $status,
                'aired' => $aired,
                'genre' => $genre,
                'genre_name' => $genre_name,
                'created_at' => $created_at
            );

            //Push to "data"
            array_push($movies_arr['data'], $movie_item);
        }

        //Turn to JSON & output
        header('HTTP/1.1 200 OK');
        echo json_encode($movies_arr);
    }
    else
    {
        //no movies
        header('HTTP/1.1 204 No Content');
        echo json_encode(array(
            'message' => 'No movies found'
        ));
    }
?>