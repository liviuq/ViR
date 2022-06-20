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

    //Get the ID from the URL
    $movie->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Call read_single on this object
    $movie->read_single();

    //Create array
    $movie_arr = array(
        'id' => $movie->id,
        'title' => $movie->title,
        'banner' => $movie->banner,
        'synopsis' => html_entity_decode($movie->synopsis),
        'rating' => $movie->rating,
        'actors' => $movie->actors,
        'director' => $movie->director,
        'writer' => $movie->writer,
        'status' => $movie->status,
        'aired' => $movie->aired,
        'genre' => $movie->genre,
        'genre_name' => $movie->genre_name,
        'created_at' => $movie->created_at
    );

    //Convert to JSON
    header('HTTP/1.1 200 OK');
    print_r(json_encode($movie_arr));
?>