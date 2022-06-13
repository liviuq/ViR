<?php
    class Review{
        private $conn;
        private $table = 'reviews';

        private $id;
        private $user_id;
        private $movie_id;
        private $body;
        private $rating;
        private $created_at;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read_movie_reviews()
        {
            $query = '
            select 
                r.id,
                r.user_id,
                r.movie_id,
                r.body,
                r.rating,
                r.created_at
            from ' . htmlspecialchars(strip_tags($this->table)) . ' r
            where r.movie_id = :movie_id
            order by r.created_at desc';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':movie_id', $this->movie_id);
            $stmt->execute();

            return $stmt;
        }

    }
?>