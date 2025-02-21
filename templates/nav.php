<nav>   
        <a href="<?php echo BASE_URL; ?>index.php"><h1>CMS</h1></a>
        <a href="<?php echo BASE_URL; ?>login.php"><?php if (!isset($_SESSION['logged_in'])) echo "Login"?></a>
        <a href="<?php echo BASE_URL; ?>register.php"><?php if (!isset($_SESSION['logged_in'])) echo "Register"?></a>
        <a href="<?php if (isset($_SESSION['admin'])) echo BASE_URL . "pages/admin.php"; else echo BASE_URL . "pages/view-users-post.php";?>">
                <?php if (isset($_SESSION['logged_in'])) 
                        {
                                if (isset($_SESSION['admin']))
                                {
                                        echo "Admin Dashboard";
                                } else {
                                        echo "View your posts";
                                }
                        }
                ?>
        </a>
        <a href="<?php echo BASE_URL; ?>pages/add-post.php"><?php if (isset($_SESSION['logged_in'])) echo "Add Post"; ?></a>
        <a href="<?php echo BASE_URL; ?>logout.php"><?php if (isset($_SESSION['logged_in'])) echo "Logout"; ?></a>
</nav>

