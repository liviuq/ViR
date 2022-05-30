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
    }
?>