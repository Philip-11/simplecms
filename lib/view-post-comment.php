<?php 
require_once '../lib/auth.php';

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