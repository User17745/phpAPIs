<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    // "DELETE" method is used for delete queries.
    header("Access-Control-Allow-Methods: DELETE");
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
            
            if($post->delete())
                echo json_encode(array("message" => " Success: Post Deleted."));
            else
                echo json_encode(array("message" => "Error: Cloud not delete post, error occurred"));
        }
        else echo json_encode(array("message" => "Error: Cloud not delete post, ID is required."));
    }
    else
        echo json_encode(array("message" => "Error: Cloud not delete post, data empty"));