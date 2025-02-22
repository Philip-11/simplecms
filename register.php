<?php 

require_once 'lib/common.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email, usr_level) VALUES (:username, :password, :email, :usr_level)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array('username' => $username, 'password' => $hashed_password, 'email' => $email, 'usr_level' => 2));

    echo "Successfully registered";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php require 'templates/nav.php' ?>
    <h2>Register here:</h2>
    <form action="<?php echo htmlEscape($_SERVER['PHP_SELF']) ?>" method="post"> 
        <label for="username">Username: </label><input type="text" name="username" id="username" required> <br>
        <label for="password">Password: </label><input type="password" name="password" id="password" required> <br>
        <label for="email">Email: </label><input type="email" id="email" name="email" required> <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>