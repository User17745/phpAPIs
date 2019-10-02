<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Post.php";

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    $post->id = isset($_GET["id"]) ? $_GET["id"] : die();
    $result = $post->read_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);
    
    $post_arr = array(
        "id" => $id,
        "title" => $title,
        "body" => html_entity_decode($body),
        "author" => $author,
        "category_id" => $category_id,
        "category_name" => $category_name,
    );
    
    // Instead of echo, we can also use print_r() which is used to print an array.
    echo json_encode($post_arr);
