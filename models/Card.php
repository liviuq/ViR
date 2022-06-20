<?php
    //This is the class that represents the movies when you land on index.php
    class Card
    {
        //DB stuff
        private $conn;
        private $table = 'movies'; //because we need just the movie id, banner and genre_name

        //Properties
        public $id;
        public $banner;
        public $genre_name;

        //Constructor with DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //Get all cards
        /**
         * @OA\Get(
         *     path="/api/card/read.php", tags={"Cards"},
         *     summary="Returns all movie cards",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="204", description="No Content")
         * )
         */
        public function read()
        {
            //Create query
            $query = '
            select 
                g.name as genre_name,
                m.id,
                m.banner 
            from ' . htmlspecialchars(strip_tags($this->table)) . ' m
            left join categories g on m.genre = g.id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //getfav for user
        /**
         * @OA\Get(
         *     path="/api/card/read.php", tags={"Favourites"},
         *     summary="Returns all user's favourites in card format",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="204", description="No Content")
         * )
         */
        public function read_user_favourites_and_display($username)
        {
            //query
            $query = '
            select 
                m.id,
                m.banner 
            from ' . htmlspecialchars(strip_tags($this->table)) . ' m
            join favourites f on f.movie_id= m.id
            where f.user_id=(select id from users where username = :username)
            ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $username = htmlspecialchars(strip_tags($username));

            //Bind data
            $stmt->bindParam(':username', $username);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get cards related to the search box
        /**
         * @OA\Get(
         *     path="/api/card/search.php", tags={"Search"},
         *     summary="Returns all matching movies in card format",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="204", description="No Content")
         * )
         */
        public function search($string)
        {
            //Create query
            $query = '
            select 
                g.name as genre_name,
                m.id,
                m.banner 
            from ' . htmlspecialchars(strip_tags($this->table)) . ' m
            left join categories g on m.genre = g.id 
            where trim(lower(m.title)) like  \'%' . htmlspecialchars(strip_tags(strtolower(trim($string)))) .'%\' 
            or trim(lower(m.actors)) like  \'%' . htmlspecialchars(strip_tags(strtolower(trim($string)))) .'%\' 
            or trim(lower(m.director)) like  \'%' . htmlspecialchars(strip_tags(strtolower(trim($string)))) .'%\' 
            or trim(lower(m.writer)) like  \'%' . htmlspecialchars(strip_tags(strtolower(trim($string)))) .'%\'';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            if($stmt->execute())
            {
                return $stmt;
            }

            return 1;
        }
    }
?>