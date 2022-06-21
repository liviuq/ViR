<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * @OA\Info(
 *   title="VIR API",
 *   version="1.0.0",
 *   @OA\Contact(
 *     email="petrache.andrei1@gmail.com"
 *   )
 * )
 */
class Authentication
{
    //DB stuff
    private $conn;
    private $table = 'users';

    //Configs
    private $secret_Key  = 'U4H`r%G8zY/y\YcA8ueLu,[{MT89AZcE';
    private $domainName = "https://vira3.herokuapp.com";
    private $username;
    private $password;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function set_username($username)
    {
        $this->username = $username;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    //only post the username and password
    /**
     * @OA\Post(
     *     path="/api/authentication/login.php", tags={"Authentication"},
     *     summary="Authenticate an user",
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="500", description="Internal Server Error")
     * )
     */
    public function processRequest()
    {
        //return values
        //0-user exists and the credentials are valid
        //1-Wrong username or password
        //2-Only POST actions are allowed
        //3-SQL error

        //$_SERVER["REQUEST_METHOD"]
        if($_SERVER["REQUEST_METHOD"] == 'POST')
        {
            //require username and password
            //verify their existence on the db, don t forget to hash the password
            $query = 'select count(*) from ' . $this->table .
            ' where username = :username and password = :password';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //hash password
            $password_hashed = hash('sha256', $this->password);

            //Bind parameters
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_hashed, PDO::PARAM_STR);

            //execute statement
            if($stmt->execute())
            {
                //check to see if we can register
                $counter = $stmt->fetchColumn();

                if($counter > 0)
                {
                    //the user exists and the credentials are valid
                    $response = $this->createJWT($this->username);
                    // header('HTTP/1.1 200 OK');
                    header($response['status_code_header']);
                    header($response['content_type_header']);
                    if ($response['body'])
                    {
                        echo json_encode(array(
                            'message' => $response['body']
                        ));
                    }
                    return 0;
                }
                else
                {
                    //no user with those credentials
                    header('HTTP/1.1 401 Unauthorized');
                    echo json_encode(array(
                        'message' => 'Wrong username or password'
                    ));
                    return 1;                    
                }
            }
            else
            {
                //couldn t execute statement
                header('HTTP/1.0 500 Internal Server Error');
                echo json_encode(array(
                    'message' => 'Internal server error'
                ));
                return 3;
            }
        }
        else
        {
            //Only POST actions are allowed
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(array(
                'message' => 'Only POST actions are allowed'
            ));
            return 2;
        }      
    }

    private function createJWT($username)
    {
        $secret_Key = $this -> secret_Key;
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+10 minutes')->getTimestamp();
        $domainName = $this -> domainName;
        //edit this username to match the login one
        $request_data =
        [
            'iat'  => $date->getTimestamp(),         // ! Issued at: time when the token was generated
            'iss'  => $domainName,                   // ! Issuer
            'nbf'  => $date->getTimestamp(),         // ! Not before
            'exp'  => $expire_at,                    // ! Expire
            //here too!!
            'username' => $username,                 // User name
        ];

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';
        $response['body'] = JWT::encode(
            $request_data,
            $secret_Key,
            'HS512'
        );
        return $response;
    }

    function checkJWTExistance()
    {
        // Check JWT
        if (! preg_match('/Bearer\s(\S+)/', $this -> getAuthorizationHeader(), $matches))
        {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(array(
                'message' => 'Token not found in request'
            ));
            return 1;
        }
        return $matches[1];
    }

    function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization']))
        {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION']))
        {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        }
        elseif (function_exists('apache_request_headers'))
        {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization']))
            {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    public function validateJWT( $jwt )
    {
        $secret_Key = $this -> secret_Key;

        try
        {
            $token = JWT::decode($jwt, new Key($secret_Key, 'HS512'));
        }
        catch (Exception $e)
        {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(array(
                'message' => 'Invalid token'
            ));
            return 1;
        }
        $now = new DateTimeImmutable();
        $domainName = $this -> domainName;

        if ($token->iss !== $domainName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(array(
                'message' => 'Invalid token'
            ));
            return 1;
        }

        //good token
        return 0;
    }
}