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
                die();
            }
        }

        //Get user favourites
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
        public function create()
        {
            //Create query
            $query = 'insert into ' . htmlspecialchars(strip_tags($this->title)) . ' (user_id, movie_id) values (:user_id, :movie_id)';

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

        //Delete favourite
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