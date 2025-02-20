<?php 

require_once "../lib/auth.php";

$post_id = $_GET['post_id'];
$post = getSinglePostById($conn, $post_id);

if ($_POST)
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $body = $_POST['body'];
    editPost($conn, $title, $description, $body, $post_id);

    echo "Successfully Updated Post";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
<?php require "../templates/nav.php"?>
<h2>Edit Post:</h2>
    <form action="" method="post">
        <h2><label for="">Post Title</label> <br>
        <input type="text" name="title" style="width: 50%; height: 48px;" value="<?php echo htmlEscape($post['title'])?>" required> </h2>

        <h2><label for="">Short Description</label> <br>
            <textarea name="description" cols="120" rows="6" required>
                <?php echo htmlEscape($post['description'])?>
            </textarea>
        </h2>

        <h2><label for="">Body</label> <br>
            <textarea name="body" cols="120" rows="10" required>
                <?php echo htmlEscape($post['body'])?>
            </textarea>
        </h2>

        <button type="submit">Submit</button>
    </form>
</body>
</html>