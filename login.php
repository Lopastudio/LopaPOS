<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $users = file("passwrd.lpd", FILE_IGNORE_NEW_LINES);

        foreach ($users as $user) {
            list($username, $hashed_password) = explode(":", $user);

            if ($_POST['username'] === $username && password_verify($_POST['password'], $hashed_password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                session_regenerate_id();
                header("Location: index.php");
                exit;
            }
        }
        echo "Invalid username or password.";
    }
}
?>
