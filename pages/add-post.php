<?php 

require_once '../lib/auth.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $body = $_POST['body'];
    $user_id = $_SESSION['id'];

    $sql = "INSERT INTO posts (title, description, body, created_at, user_id) VALUES (:title, :description, :body, :created_at, :user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        'title' => $title, 
        'description' => $description, 
        'body' => $body, 
        'created_at' => date('Y-m-d H:i:s'),
        'user_id' => $user_id,
    ));

    echo "Successfully added post";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
</head>
<body>
    <?php require '../templates/nav.php' ?>
    <h2>Add Post:</h2>
    <form action="" method="post">
        <h2><label for="">Post Title</label> <br>
        <input type="text" name="title" style="width: 50%; height: 48px;" required> </h2>

        <h2><label for="">Short Description</label> <br>
        <textarea name="description" cols="120" rows="6" required></textarea></h2>

        <h2><label for="">Body</label> <br>
        <textarea name="body" cols="120" rows="10" required></textarea></h2>

        <button type="submit">Submit</button>
    </form>
</body>
</html>