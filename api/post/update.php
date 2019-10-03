<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    // "PUT" method is used for update queries.
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/Post.php";

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data)) {
        if(isset($data->id)){
            $post->id = $data->id;            
            
            if(isset($data->title)){
                $post->title = $data->title;
            }
            if(isset($data->body)){
                $post->body = $data->body;
            }
            if(isset($data->author)){
                $post->author = $data->author;            
            }
            if(isset($data->category_id)){
                $post->category_id = $data->category_id;            
            }
            
            if($post->update())
                echo json_encode(array("message" => " Success: Post Updated."));
            else
                echo json_encode(array("message" => "Error: Cloud not update post, error occurred"));
        }
        else echo json_encode(array("message" => "Error: Cloud not update post, ID is required."));
    }
    else
        echo json_encode(array("message" => "Error: Cloud not update post, data empty"));