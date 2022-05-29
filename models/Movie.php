<?php
    class Movie
    {
        //DB stuff
        private $conn;
        private $table = 'movies';

        //Movie properties
        public $id;
        public $title;
        public $banner;
        public $synopsis;
        public $rating;
        public $actors;
        public $director;
        public $writer;
        public $status;
        public $aired;
        public $genre_id;
        public $genre_name;
        public $created_at;

        //Constructor with DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //Get Movies
        public function read()
        {
            //Create the query
            $query = '
            SELECT 
                c.name as genre_name,
                m.id,
                m.genre,
                m.title,
                m.banner,
                m.synopsis,
                m.rating,
                m.created_at
            from ' . $this->table . ' m
            left join categories c on m.genre = c.id
            order by m.created_at desc';

            //Prepare statement
            $stmt = $this->conn->prepare($query);
           
            //Execute query
            $stmt->execute();

            return $stmt;
        }
    }
?>