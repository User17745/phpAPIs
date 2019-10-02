<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    // Enabled POST method to be used.
    header("Access-Control-Allow-Methods: POST");
    // Enables the us to specify a list of acceptable headers 
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With");
    //Note 1: Authorization is specified above but not used by us.
    //Note 2: X-Requested-With helps us avoid attacks like CSRF, etc.

    include_once "../../config/Database.php";
    include_once "../../models/Post.php";

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data)) {
        $post->title = $data->title;
        $post->body = $data->body;
        $post->author = $data->author;
        $post->category_id = $data->category_id;

        if($post->create())
            echo json_encode(array("message" => "Post Created Successfully."));
        else
            echo json_encode(array("message" => "Cloud not create post, error occurred"));
    }
    else
        echo json_encode(array("message" => "Cloud not create post, data empty"));