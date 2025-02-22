<?php 
require_once '../lib/auth.php';

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
    switch ($_GET['action'])
    {
        case 'add-comment':
            $commentData = array(
                'name' => $_POST['comment-name'],
                'website' => $_POST['comment-website'],
                'text' => $_POST['comment-text'], 
            );
        
            $outcome = addCommentToPost($conn, $postId, $commentData);
            break;
        case 'delete-comment':
            if (isset($_SESSION['logged_in']))
            {
                $deleteId = $_POST['delete-comment'];
                if ($deleteId)
                {
                    $keys = array_keys($deleteId);
                    $deleteCommentId = $keys[0];
                    deleteComment($conn, $deleteCommentId, $postId);
                    //Work on this deleting comment
                }
            }
            
            break;
    }
    
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

    <?php //Already escaped ?>
    <p><?php echo $paraText ?></p>

    <?php require '../templates/list-comments.php'?>

    <?php require '../templates/comment-form.php'?>
</body>
</html>