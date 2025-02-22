<?php 
require_once '../lib/auth.php';


?>
<h3><?php echo countAllCommentsForPosts($postId, $conn) ?> comments</h3>
    <?php if (isset($outcome)): ?>
        <h3>Successfully Added Comment</h3>
    <?php endif ?>

    <form action="view-post.php?action=delete-comment&amp;post_id=<?php echo $postId?>" method="post">
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
            <div>
                <?php if (isset($_SESSION['admin'])):?>
                    <input type="submit" value="Delete" name="delete-comment[ <?php echo $comment['id'] ?>]">
            </div>
                <?php endif ?>
    <?php endforeach ?>
    </form>