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

        /**
         * @OA\Get(
         *     path="/api/review/read_movie_reviews.php", tags={"Reviews"},
         *     summary="Returns movie's reviews",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="204", description="No Content")
         * )
         */
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
            where r.movie_id = :movie_id and length(r.body)!=0
            order by r.created_at desc';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':movie_id', $this->movie_id);
            $stmt->execute();

            return $stmt;
        }

        //publish a review
        /**
         * @OA\Post(
         *     path="/api/review/create.php", tags={"Reviews"},
         *     summary="Creates a review on the specified movie",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="404", description="Not Found"),
         *     @OA\Response(response="500", description="Internal Server Error")
         * )
         */
        public function create($username)
        {
            //Query to insert review
            $query = 'insert into ' . $this->table .  ' (user_id, movie_id, body, rating)
            values((select id from users where username = :username), :movie_id, :body, :rating)';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':movie_id', $this->movie_id);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->execute();

            //Add this review to the rss table
            $query = 'insert into rss (title, body, rating, author, category) 
            values ((select title from movies where id = :movie_id), :body,
            :rating, :username, \'Review\')';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':movie_id', $this->movie_id);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->bindParam(':username', $username);
            
            $stmt->execute();
        }
    }
?>