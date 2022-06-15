<?php
    class Review{
        private $conn;
        private $table = 'reviews';

        public $id;
        public $user_id;
        public $movie_id;
        public $body;
        public $rating;
        public $created_at;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read_movie_reviews()
        {
            $query = '
            select 
                u.username,
                r.id,
                r.user_id,
                r.movie_id,
                r.body,
                r.rating,
                r.created_at
            from ' . htmlspecialchars(strip_tags($this->table)) . ' r
            left join users u on u.id = r.user_id
            where r.movie_id = :movie_id
            order by r.created_at desc';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':movie_id', $this->movie_id);
            $stmt->execute();

            return $stmt;
        }

        //publish a review 
        public function create($username)
        {
            $query = 'insert into ' . $this->table .  ' (user_id, movie_id, body, rating)
            values((select id from users where username = :username), :movie_id, :body, :rating)';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':movie_id', $this->movie_id);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->execute();
        }
    }
?>