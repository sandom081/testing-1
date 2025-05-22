<?php
session_start();

$correct_username = "admin";
$correct_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<style>
  /* Center and style container */
  body {
    margin: 0; padding: 0;
    background: linear-gradient(135deg, #1f4037, #99f2c8);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: bgAnimation 10s ease infinite alternate;
  }
  @keyframes bgAnimation {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
  }

  .login-container {
    background: rgba(0,0,0,0.75);
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 0 25px rgba(0,255,204,0.4);
    width: 320px;
    color: #00ffcc;
    text-align: center;
    animation: fadeIn 1s ease forwards;
  }

  @keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
  }

  h2 {
    margin-bottom: 24px;
  }

  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 18px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
    transition: box-shadow 0.3s ease;
  }

  input[type="text"]:focus, input[type="password"]:focus {
    box-shadow: 0 0 8px #00ffcc;
  }

  input[type="submit"] {
    background: #00ffcc;
    border: none;
    padding: 12px 0;
    width: 100%;
    border-radius: 6px;
    font-weight: bold;
    color: #000;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  input[type="submit"]:hover {
    background: #00ccaa;
  }

  p.error {
    color: #ff4444;
    margin-bottom: 15px;
    font-weight: bold;
  }
</style>
</head>
<body>
  <div class="login-container">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username" required autofocus>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
  </div>
</body>
</html>
