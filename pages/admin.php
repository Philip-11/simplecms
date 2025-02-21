<?php 

require_once "../lib/auth.php";

//Checks if you're an admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true)
{
    header("Location: " . BASE_URL . "index.php");
    exit();
}

$posts = getAllPosts($conn);

if ($_POST)
{
    $deleteId = $_POST['delete-post'];
    if ($deleteId)
    {
        $keys = array_keys($deleteId);
        $deletePostId = $keys[0];
        deletePost($conn, $deletePostId);
        header("Location: admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        table, tr, td {
            border: 2px solid black;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <?php require "../templates/admin-nav.php"; ?>
    <h2><?php if (isset($_SESSION['logged_in'])) echo "Hello Admin " . $_SESSION['username'] . "!"; ?></h2>
<form action="" method="post">
        <table>
            <h2>Posts:</h2>
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
                            <input type="submit" value="Delete" name="delete-post[<?php echo $row['id']?>]">
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>
</body>
</html>