<nav>   
        <a href="index.php"><h1>CMS</h1></a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="pages/add-post.php"><?php if (isset($_SESSION['logged_in'])) echo "Add Post"; ?></a>
        <a href="logout.php"><?php if (isset($_SESSION['logged_in'])) echo "Logout"; ?></a>
</nav>