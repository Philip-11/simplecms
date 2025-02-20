<?php 
require_once "../lib/auth.php";

$sql = "SELECT id, title, description, body, created_at FROM posts WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);

if ($stmt === false)
{
    throw new Exception("Something is wrong at the query");
}

$stmt->execute(array('user_id' => $_SESSION['id']));
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                            <a href="">Edit Post</a>
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
