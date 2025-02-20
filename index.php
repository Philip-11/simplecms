<?php 
require_once 'lib/common.php';


$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
</head>
<body>
    <?php require 'templates/nav.php'?>
    <h2><?php if (isset($_SESSION['logged_in'])) echo "Hello " . $_SESSION['username'] . "!"; ?></h2>
    <hr />
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <h2> <?php echo htmlEscape($row['title']); ?> </h2>
    <div> <?php echo htmlEscape($row['created_at']); ?> </div>
    <p> <?php echo htmlEscape($row['description']); ?> </p>
    <p>
        <a href="pages/view-post.php?post_id=<?php echo (int) $row['id']?>" 
        >Read more...</a>
    </p>
    <hr />
    <?php endwhile ?>
</body>
</html>