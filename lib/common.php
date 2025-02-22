<?php 
//Displays errors
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();


define("SERVER_NAME", "localhost");
define("USER_NAME", "root");
define("SERVER_PASSWORD", "root");
define("BASE_URL", "/simplecms/");


try {
    $conn = new PDO("mysql:host=localhost;dbname=sirjaycms", USER_NAME, SERVER_PASSWORD);
    //Set the pdo error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed" . $e->getMessage();
}

function htmlEscape($html)
{
    return htmlspecialchars($html, ENT_HTML5, 'UTF-8');
}

function countAllCommentsForPosts($postId, $conn)
{
    $sql = "SELECT COUNT(*) c FROM comments WHERE post_id = :post_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("post_id" => $postId));

    return (int) $stmt->fetchColumn();
}

function getAllCommentsForPosts($postId, $conn)
{
    $sql = "SELECT id, created_at, name, website, text FROM comments WHERE post_id = :post_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("post_id" => $postId));

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addCommentToPost($conn, $postId, array $commentData)
{
    $sql = "INSERT INTO comments (post_id, created_at, name, website, text) VALUES (:post_id, :created_at, :name, :website, :text)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false)
    {
        throw new Exception("Something is wrong in preparing statement");
    }

    $result = $stmt->execute(array_merge(
        array(
        'post_id' => $postId,
        'created_at' => date('Y-m-d H:i:s')
    ),
    $commentData));

    if ($result === false)
    {
        throw new Exception("Something is wrong in executing statement");
    }
}

function getAllPosts($conn)
{
    
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPostById($conn, $id)
{
    $sql = "SELECT id, title, description, body, created_at FROM posts WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);

    if ($stmt === false)
    {
        throw new Exception("Something is wrong at the query");
    }

    $stmt->execute(array('user_id' => $id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSinglePostById($conn, $id)
{
    $sql = "SELECT title, description, body, created_at FROM posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute(array('id' => $id, ));

    if ($result === false)
    {
        throw new Exception('Theres a problem in the query');
    }
    //Get a row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row === false)
    {
        throw new Exception('There was a problem in getting a row');
    }

    return $row;
}

function editPost($conn, $title, $description, $body, $postId)
{
    $sql = "UPDATE posts SET title = :title, description = :description, body = :body WHERE id = :post_id";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute(
        array(
            'title' => $title,
            'description' => $description,
            'body' => $body,
            'post_id' => $postId,
        )
    );

    return true;
}

function deletePost($conn, $postId)
{
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    if ($stmt === false)
    {
        throw new Exception("There was a problem in the query");
    }
    $result = $stmt->execute(array('id' => $postId));
    if ($result === false)
    {
        throw new Exception("There was a problem in executing the query");
    }

    return true;
}

function deleteComment($conn, $commentId, $postId)
{
    $sql = "DELETE FROM comments WHERE id = :commentId AND post_id = :postId";
    $stmt = $conn->prepare($sql);
    if ($stmt === false)
    {
        throw new Exception("There was a problem in this query");
    }
    $result = $stmt->execute(array('commentId' => $commentId, 'postId' => $postId));
    if ($result === false)
    {
        throw new Exception("There was a problem in deleting this comment");
    }

    return $result !== false;
}