<?php
    //this class represents a user
    class User
    {
        ///DB stuff
        private $conn;
        private $table = 'users';

        //Properties
        public $id;
        public $email;
        public $username;
        public $password;

        //Constructor with DB
        public function __construct($db)
        {
            $this->conn = $db;
        }
        
        //Register user (POST)  
        /**
         * @OA\Post(
         *     path="/api/user/create.php", tags={"users"},
         *     summary="Creates a user",
         *     @OA\Response(response="200", description="OK"),
         *     @OA\Response(response="500", description="Internal Server Error")
         * )
         */ 
        public function register()
        {
            //check to see if there are any users matching the email or username
            
            $query = 'select count(*) from ' . $this->table
            . ' where email = :email or username = :username';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind parameters
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);

            //Execute query
            $stmt->execute();

            //check to see if we can register
            $counter = $stmt->fetchColumn();

            if($counter > 0)
            {
                //we already have a user with the same email or username
                return false; //could not register
            }
            else
            {
                //there are no matches for username or email

                //hash password
                $password_hashed = hash('sha256', $this->password);

                //add user to the users table
                $query2 = 'insert into ' . $this->table . 
                '(email, username, password) 
                values (:email, :username, :password_hashed)';

                //Prepare statement
                $stmt2 = $this->conn->prepare($query2);

                //Bind parameters
                $stmt2->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt2->bindParam(':username', $this->username, PDO::PARAM_STR);
                $stmt2->bindParam(':password_hashed', $password_hashed, PDO::PARAM_STR);

                //execute statement
                if($stmt2->execute())
                {
                    return true;
                }
                else
                {
                    //couldn t execute statement
                    return false;
                }
            }
        }

    }
?>