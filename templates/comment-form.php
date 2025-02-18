<?php 
require_once '../lib/auth.php';
//Used to separate the commenting form
?>
<hr />

<h3>Add your comment</h3>

<form action="" method="post">
    <p>
        <label for="comment-name">Name:</label>
        <input type="text" id="comment-name" name="comment-name" required>
    </p>
    <p>
        <label for="comment-website">Website:</label>
        <input type="text" id="comment-website" name="comment-website">
    </p>
    <p>
        <label for="comment-text">Comment:</label>
        <textarea name="comment-text" id="comment-text" rows="8" cols="70" required></textarea>
    </p>

    <input type="submit" value="Submit comment">
</form>
