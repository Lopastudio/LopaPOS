<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-6">User Registration</h2>
        <form action="register.php" method="post">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="confirm_password" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
                <a href="./" class="text-blue-500 hover:underline">Already have an account? Login</a>
            </div>
        </form>
    </div>
    <div class="container">
        <?php
        $registrationEnabled = true; // Change this flag to enable/disable registration

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!$registrationEnabled) {
                echo "<p>Registration is disabled. If you are the website's admin, see docs.<p>";
                exit;
            }
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                echo "Passwords do not match.";
                exit;
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $userData = "$username:$hashed_password\n";
            file_put_contents("HJKOGFSDHfuHFIU.HFU", $userData, FILE_APPEND | LOCK_EX);
            
            echo "<script type='text/javascript'>alert('Registration successful :)');</script>";
        }
        ?>
    </div>
</body>
</html>
