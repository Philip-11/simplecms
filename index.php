<?php 
require_once 'lib/common.php';

$posts = getAllPosts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/index.css">
</head>
<body>
    <?php require 'templates/nav.php'?>

    
    <?php foreach ($posts as $row): ?>
    <div class="post">
        <div class="post-head">
            <h2> <?php echo htmlEscape($row['title']); ?> </h2>
        </div>
        
        <div class="post-date"> <?php echo htmlEscape($row['created_at']); ?> </div>
        <p class="post-description"> <?php echo htmlEscape($row['description']); ?> </p>
        <p>
            <a class="post-button" href="pages/view-post.php?post_id=<?php echo (int) $row['id']?>" 
            >Read more...</a>
        </p>
    </div>
    
   
    <?php endforeach ?>
</body>
</html>