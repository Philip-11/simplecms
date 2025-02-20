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