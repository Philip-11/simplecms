<?php

require_once 'lib/common.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array('username' => $username));
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password']))
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Login failed";
        echo $error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require '../templates/nav.php' ?>
    <div>
        <form action="<?php echo htmlEscape($_SESSION['PHP_SELF']); ?>" method="post">
            <label for="username">Username: </label><input type="text" name="username" id="username"> <br>
            <label for="password">Password: </label><input type="password" name="password" id="password"> <br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>