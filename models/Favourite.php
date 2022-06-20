<?php
    //class representing favourites
    class Favourite
    {
        //DB stuff
        private $conn;
        private $table = 'favourites';
        
        //Favourites properties
        public $id;
        public $user_id;
        public $movie_id;
        public $created_at;

        //Constructor with DB
        public function __construct($db, $username)
        {
            $this->conn = $db;

            //set the user_id based on the username
            //Prepare the query
            $query = 'select id from users where username = :username';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //$stmt->debugDumpParams();

            //Clean data
            $username = htmlspecialchars(strip_tags($username));

            //Bind data
            $stmt->bindParam(':username', $username);

            //Execute query
            $stmt->execute();

            //sanity check for result
            if($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                //user exists so we set the user_id
                $this->user_id = $row['id'];
            }
            else
            {
                echo 'Constructor in favourite has gone mad';
                die();
            }
        }

        //Get user favourites
        /**
         * @OA\Get(
         *     path="/api/favourite/read_user_favourites.php", tags={"Favourites"},
         *     summary="Returns user's favourite movies",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="204", description="No Content")
         * )
         */
        public function read_user_favourites()
        {
            //query
            $query = ' select f.movie_id, f.created_at, m.title 
                        from ' . htmlspecialchars(strip_tags($this->table)) . ' f 
                        join movies m on f.movie_id = m.id 
                        where f.user_id = :user_id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //$stmt->debugDumpParams();

            //Clean data
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //Bind data
            $stmt->bindParam(':user_id', $this->user_id);

            //Execute query
            $stmt->execute();

            return $stmt;
        }
       
        

        //Create favourite
        /**
         * @OA\Post(
         *     path="/api/favourite/create.php", tags={"Favourites"},
         *     summary="Creates user's favourite movie",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="404", description="Not Found"),
         *     @OA\Response(response="500", description="Internal Server Error"),
         *     @OA\Response(response="409", description="Conflict")
         * )
         */
        public function create()
        {
            //first check to see if the movie is already in user's fav list
            $query = 'select * from ' . $this->table . 
            ' where user_id = :user_id and movie_id = :movie_id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->movie_id = htmlspecialchars(strip_tags($this->movie_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //Bind data
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':movie_id', $this->movie_id);

            //execute
            $stmt->execute();

            //check to see if the number is greater than 0
            $num = $stmt->rowCount();
            if($num != 0)
            {
                return 2;
            }
            
            //Create query
            $query = 'insert into ' . htmlspecialchars(strip_tags($this->table)) . ' (user_id, movie_id) values (:user_id, :movie_id)';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->movie_id = htmlspecialchars(strip_tags($this->movie_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //Bind data
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':movie_id', $this->movie_id);

            //Execute query
            if($stmt->execute())
            {
                return 0;
            }

            //Print error if smth goes wrong
            printf("Error: %s\n", $stmt->error);
            return 1;
        }

        //Delete favourite
        /**
         * @OA\Delete(
         *     path="/api/favourite/delete.php", tags={"Favourites"},
         *     summary="Deletes a favourite",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="401", description="Unauthorized"),
         *     @OA\Response(response="400", description="Bad Request"),
         *     @OA\Response(response="404", description="Not Found"),
         *     @OA\Response(response="500", description="Internal Server Error"),
         * 
         */
        public function delete()
        {
            //Create query
            $query = 'delete from ' . htmlspecialchars(strip_tags($this->table)) . ' 
            where user_id = :user_id and movie_id = :movie_id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->movie_id = htmlspecialchars(strip_tags($this->movie_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //Bind data
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':movie_id', $this->movie_id);

            //Execute query
            if($stmt->execute())
            {
                return true;
            }

            //Print error if smth goes wrong
            printf("Error: %s\n", $stmt->error);
            return false;
        }
    }
?>