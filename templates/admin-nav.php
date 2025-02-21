<nav>   
    <a href="<?php echo BASE_URL; ?>index.php"><h1>CMS</h1></a>
    <a href="<?php echo BASE_URL; ?>login.php"><?php if (!isset($_SESSION['logged_in'])) echo "Login"?></a>
    <a href="<?php echo BASE_URL; ?>register.php"><?php if (isset($_SESSION['logged_in'])) echo "Register"?></a>
    <a href="<?php echo BASE_URL; ?>pages/add-post.php"><?php if (isset($_SESSION['logged_in'])) echo "Add Post"; ?></a>
    <a href="<?php echo BASE_URL; ?>logout.php"><?php if (isset($_SESSION['logged_in'])) echo "Logout"; ?></a>
</nav>