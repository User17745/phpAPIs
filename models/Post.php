<?php
    class Post {
        // Database related variables
        private $conn;
        private $tableName = 'posts';

        // Table Properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;
    
        // Constructor takes in the DB connection and stores it locally.
        public function __construct($db) {
            $this->conn = $db;
        }

        // This will run the query in MySQL and return the result.
        // This function will return all of the posts.
        public function read() {
            $query = 
                "SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM 
                    " . $this->tableName . " p 
                LEFT JOIN
                    categories c
                ON 
                    p.category_id = c.id
                ORDER BY
                    created_at DESC;
                ";
            
            //Preparing a statement to be executed
            $statement = $this->conn->prepare($query);

            $statement->execute();

            return $statement;
        }

        // This function will return only a single post identified using its ID.
        public function read_single() {
            $query = 
                "SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM 
                    " . $this->tableName . " p 
                LEFT JOIN
                    categories c
                ON 
                    p.category_id = c.id
                WHERE
                    p.id = ?;
                ";

            $statement = $this->conn->prepare($query);

            // Defining the missing parameter within the $query which is market by a question mark (?).
            $statement->bindParam(1, $this->id);

            $statement->execute();

            return $statement;
        }

        // This function will create a new post (will add a row in the DB table).
        public function create() {
            $query = 
                "INSERT INTO " . $this->tableName . "
                SET
                    title = :title,
                    body = :body,
                    author = :author,
                    category_id = :category_id;
                ";

            $statement = $this->conn->prepare($query);

            // Cleaning the data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = $this->body;
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            
            $statement->bindParam(":title", $this->title);
            $statement->bindParam(":body", $this->body);
            $statement->bindParam(":author", $this->author);
            $statement->bindParam(":category_id", $this->category_id);

            if($statement->execute())
                return true;
            
            printf("Error while creating new post: %s\n", $statement->error);
            return false;
        }
    }