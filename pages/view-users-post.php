<?php 
require_once "../lib/auth.php";

$posts = getPostById($conn, $_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Posts</title>
    <style>
        table, tr, td {
            border: 1px solid black;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <?php require "../templates/nav.php"?>
    <hr />
    <form action="" method="post">
        <table>
            <tbody>
                <tr>
                    <th>Title</th>
                    <th>Created at</th>
                </tr>
                <?php foreach($posts as $row):?>
                    <tr>
                        <td>
                            <?php echo htmlEscape($row['title'])?>
                        </td>
                        <td>
                            <?php echo htmlEscape($row['created_at'])?>
                        </td>
                        <td>
                            <a href="view-post.php?post_id=<?php echo (int) $row['id']?>">View</a>
                        </td>
                        <td>
                            <a href="edit-post.php?post_id=<?php echo (int) $row['id']?>">Edit Post</a>
                        </td>
                        <td>
                            <a href="">Delete Post</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>
    
</body>
</html>
