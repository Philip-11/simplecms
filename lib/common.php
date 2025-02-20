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