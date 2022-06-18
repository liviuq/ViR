<?php
    //This is the class that represents the actual movie data needed to fill the movie_template.php(to be html so we can use js, a bit cleaner)
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
            //change name table 'categories' to 'genres'
            //Create the query
            $query = '
            select 
                g.name as genre_name,
                m.id,
                m.title,
                m.banner,
                m.synopsis,
                m.rating,
                m.actors,
                m.director,
                m.writer,
                m.status,
                m.aired,
                m.genre,
                m.created_at
            from ' . htmlspecialchars(strip_tags($this->table)) . ' m
            left join categories g on m.genre = g.id
            order by m.created_at desc';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //$stmt->debugDumpParams();

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //check the id (html_cpecial_char, strip, PDO::PARAM_INT, check to see if it s in bd first)
        //Get Single Movie by ID
        public function read_single()
        {
            //Create the query
            $query = '
            SELECT 
                g.name as genre_name,
                m.id,
                m.title,
                m.banner,
                m.synopsis,
                m.rating,
                m.actors,
                m.director,
                m.writer,
                m.status,
                m.aired,
                m.genre,
                m.created_at
            from ' . htmlspecialchars(strip_tags($this->table)) . ' m
            left join categories g on m.genre = g.id
            where m.id = ? limit 0,1';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

            //$stmt->debugDumpParams();

            //Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set props
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->banner = $row['banner'];
            $this->synopsis = $row['synopsis'];
            $this->rating = $row['rating'];
            $this->actors = $row['actors'];
            $this->director = $row['director'];
            $this->writer = $row['writer'];
            $this->status = $row['status'];
            $this->aired = $row['aired'];
            $this->genre = $row['genre'];
            $this->genre_name = $row['genre_name'];
            $this->created_at = $row['created_at'];
        }

        //Create Movie
        public function create()
        {
            //Create query
            $query = 'insert into ' . htmlspecialchars(strip_tags($this->table)) . ' set 
            title = :title,
            banner = :banner,
            synopsis = :synopsis,
            rating = :rating,
            actors = :actors,
            director = :director,
            writer = :writer,
            status = :status,
            aired = :aired,
            genre = :genre';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->banner = htmlspecialchars(strip_tags($this->banner));
            $this->synopsis = htmlspecialchars(strip_tags($this->synopsis));
            $this->rating = htmlspecialchars(strip_tags($this->rating));
            $this->actors = htmlspecialchars(strip_tags($this->actors));
            $this->director = htmlspecialchars(strip_tags($this->director));
            $this->writer = htmlspecialchars(strip_tags($this->writer));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->aired = htmlspecialchars(strip_tags($this->aired));
            $this->genre = htmlspecialchars(strip_tags($this->genre));

            //Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':banner', $this->banner);
            $stmt->bindParam(':synopsis', $this->synopsis);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->bindParam(':actors', $this->actors);
            $stmt->bindParam(':director', $this->director);
            $stmt->bindParam(':writer', $this->writer);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':aired', $this->aired);
            $stmt->bindParam(':genre', $this->genre);

            //Execute query
            if($stmt->execute())
            {
                //before returning, add the movie to the RSS Feed
                //Add this review to the rss table
                $query = 'insert into rss (title, body, rating, author, category) 
                values (\'New movie\', :body, \'0\', \'System\', \'Movie\')';

                //Prepare
                $stmt = $this->conn->prepare($query);

                //Sanitize input
                $new_body = 'Bring popcorn to watch ' . $this->title . '!';
                $stmt->bindParam(':body', htmlspecialchars(strip_tags($new_body)));
            
                //Execute
                $stmt->execute();

                return true;
            }

            //Print error if smth goes wrong
            printf("Error: %s\n", $stmt->error);
            return false;
        }

        //Update Movie
        public function update()
        {
            //Create query
            $query = 'update ' . htmlspecialchars(strip_tags($this->table)) . ' set 
            title = :title,
            banner = :banner,
            synopsis = :synopsis,
            rating = :rating,
            actors = :actors,
            director = :director,
            writer = :writer,
            status = :status,
            aired = :aired,
            genre = :genre 
            where id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->banner = htmlspecialchars(strip_tags($this->banner));
            $this->synopsis = htmlspecialchars(strip_tags($this->synopsis));
            $this->rating = htmlspecialchars(strip_tags($this->rating));
            $this->actors = htmlspecialchars(strip_tags($this->actors));
            $this->director = htmlspecialchars(strip_tags($this->director));
            $this->writer = htmlspecialchars(strip_tags($this->writer));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->aired = htmlspecialchars(strip_tags($this->aired));
            $this->genre = htmlspecialchars(strip_tags($this->genre));

            //Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':banner', $this->banner);
            $stmt->bindParam(':synopsis', $this->synopsis);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->bindParam(':actors', $this->actors);
            $stmt->bindParam(':director', $this->director);
            $stmt->bindParam(':writer', $this->writer);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':aired', $this->aired);
            $stmt->bindParam(':genre', $this->genre);

            //Execute query
            if($stmt->execute())
            {
                return true;
            }

            //Print error if smth goes wrong
            printf("Error: %s\n", $stmt->error);
            return false;
        }

        //Delete Movie
        public function delete()
        {
            //Create query
            $query = 'delete from ' . htmlspecialchars(strip_tags($this->table)) . ' 
            where id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':id', $this->id);

            //Execute query
            if($stmt->execute())
            {
                return true;
            }

            //Print error if smth goes wrong
            printf("Error: %s\n", $stmt->error);
            return false;
        }

        public function csv(){
            $query='select 
            title, 
            rating, 
            status, 
            aired, 
            name as genre
            from '.htmlspecialchars(strip_tags($this->table)).' join categories c on movies.created_at = c.created_at';

             //Prepare statement
             $stmt = $this->conn->prepare($query);

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