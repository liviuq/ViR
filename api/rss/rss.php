<?php
    include_once '../../config/Database.php';

    //Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    //Table is rss
    $table = 'rss';

    //Create the query
    $query = ' select * from ' . htmlspecialchars(strip_tags($table)) . 
    ' order by id desc';

    //Prepare statement
    $stmt = $db->prepare($query);

    //execute
    $stmt->execute();

    //Retrieve the rows
    $result = $stmt->fetchAll();

    //Setting the right RSS with XML
    header("Content-Type: text/xml;charset=iso-8859-1");

    //Creating the feed
    $base_url = "https://vira3.herokuapp.com/api/rss/rss.php";
    echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
    echo "<rss version='2.0'>".PHP_EOL;
    echo "<channel>".PHP_EOL;
    echo "<title>Reviews | RSS</title>".PHP_EOL;
    echo "<link>" . $base_url . "index.php</link>".PHP_EOL;
    echo "<description>RSS Feed to display new opinions about the movies</description>" . PHP_EOL;
    echo "<language>en-us</language>" . PHP_EOL;

    foreach($result as $row)
    {
        $publish_Date = $row["created_at"];
        echo "<item xmlns:dc='ns:1'>".PHP_EOL;
        echo "<title>".$row["title"]."</title>".PHP_EOL;
        echo "<guid>".md5($row["id"])."</guid>".PHP_EOL;
        echo "<pubDate>".$publish_Date."</pubDate>".PHP_EOL;
        echo "<dc:creator>".$row["author"]."</dc:creator>".PHP_EOL;
        echo "<description>" . $row["body"] . "</description>".PHP_EOL;
        echo "<rating>" . $row["rating"] . "</rating>".PHP_EOL;
        //category either review or movie
        echo "<category>" . $row["category"] . "</category>".PHP_EOL;
        echo "</item>".PHP_EOL;
    }

    echo '</channel>'.PHP_EOL;
    echo '</rss>'.PHP_EOL;
?>