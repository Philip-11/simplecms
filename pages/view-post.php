<?php 
require_once '../lib/auth.php';
require_once '../lib/view-post-comment.php';

//Get post id
if (isset($_GET['post_id']))
{
    $postId = (int) $_GET['post_id'];
    
}
else {
    //For assurance
    $postId = 0;
}


$sql = "SELECT title, description, body, created_at FROM posts WHERE id = :id";
$stmt = $conn->prepare($sql);
$result = $stmt->execute(array('id' => $postId, ));

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

//Replace line breaks with paragraph breaks
$bodyText = htmlEscape($row['body']);
$paraText = str_replace("\n", "</p><p>", $bodyText);

if ($_POST)
{
    $commentData = array(
        'name' => $_POST['comment-name'],
        'website' => $_POST['comment-website'],
        'text' => $_POST['comment-text'], 
    );

    $outcome = addCommentToPost($conn, $postId, $commentData);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <?php require '../templates/nav.php'?>

    <?php //Display all of the details of the row ?>
    <h2> <?php echo htmlEscape($row['title']) ?> </h2>

    <div><?php echo $row['created_at'] ?> </div>

    <p><strong><?php echo htmlEscape($row['description']) ?> </strong></p>

    <p><?php echo htmlEscape($row['body']) ?></p>

    <h3><?php echo countAllCommentsForPosts($postId, $conn) ?> comments</h3>
    <h3><?php if (isset($outcome)){echo "Successfully Added Comment";} ?></h3>

    <?php //Display all of the comments for a post?>
    <?php foreach (getAllCommentsForPosts($postId, $conn) as $comment): ?>
        <hr />
        <div>
            Comment from <?php echo htmlEscape($comment['name'])?>
            on <?php echo $comment['created_at'] ?>
        </div>
        <div>
            <?php echo htmlEscape($comment['text'])?>
        </div>
    <?php endforeach ?>

    <?php require '../templates/comment-form.php'?>
</body>
</html>