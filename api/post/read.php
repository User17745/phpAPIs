<?php
    //Setting HTTP Headers

    // Will allow access from all origins
    header('Access-Control-Allow-Origin: *');
    // Declares that we outputting using JSON type content 
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    $result = $post->read();
    $num_rows = $result->rowCount();

    if($num_rows) {
        $posts_arr = array();
        $posts_arr["data"] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //extract allows us to access the keys within an associative array directly as a variable $var rather than the conventional array formate ($arr["var"]).
            extract($row);

            $posts_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );
            array_push($posts_arr["data"], $posts_item);
        }
        echo json_encode($posts_arr);
    }else json_encode(
        array('message' => 'No Posts')
    );