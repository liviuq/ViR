<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: text/xml');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //helps with auth, cross site scripting, cors

    include_once '../../config/Database.php';
    include_once '../../models/Favourite.php';
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
    include_once '../../models/Authentication.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Auth object
    $auth = new Authentication($db);

    //define the username
    $username = '';

    //we need to validate jwt from header
    $token = $auth->checkJWTExistance();
    if($token != 1)
    {
        //token found
        if($auth->validateJWT($token) != 0)
        {
            //token not valid
            //validateJWT sends a header

            //die like a hero
            die();
        }
        else
        {
            //valid token
            //cool one liner to decode the JWT
            $obj = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))), true);

            //get the username
            $username = $obj['username'];
        }
    }

    //create the Favourite object
    $fav = new Favourite($db, $username);

    //Get favourites
    $result = $fav->read_user_favourites();

    //Getting row count
    $num = $result->rowCount();

    //Check to see if there are any movies
    if($num > 0)
    {
        //there are favourites

        //initialize favourite array
        $favourites_arr = array();
        $favourites_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            //f.movie_id, f.created_at, m.title
            $favourite_item = array(
                'movie_id' => $movie_id,
                'title' => $title,
                'created_at' => $created_at
            );

            //Push to "data"
            array_push($favourites_arr['data'], $favourite_item);
        }

        //Turn to JSON & output
        header('HTTP/1.1 200 OK');
        echo json_encode($favourites_arr);
    }
    else
    {
        //no favs
        header('HTTP/1.1 204 No Content');
        echo json_encode(array(
            'message' => 'No movies found'
        ));
    }

?>