<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($mysqli, $_POST['confirm_password']);

    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

            if (mysqli_query($mysqli, $sql)) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Gagal registrasi!";
            }
        } else {
            $error = "Password dan konfirmasi password tidak cocok!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pembelian Tiket Kereta</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            width: 100%;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .error {
            color: #f44336;
            text-align: center;
            margin-top: 15px;
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="register.php">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit" class="btn">Register</button>

            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>

        <div class="link">
            <p>Sudah punya akun? <a href="login.php">Login sekarang</a></p>
        </div>
    </div>

</body>
</html>
