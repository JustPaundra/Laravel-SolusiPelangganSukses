<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: admin.php");
    exit;
}

$users = isset($_SESSION['users']) ? $_SESSION['users'] : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION["username"] = $username;
            
            setcookie("username", $username, time() + (86400 * 30), "/");

            header("Location: admin.php");
            exit;
        }
    }

    $login_error = "Username atau password salah. Silakan coba lagi.";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style/login.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- Javascript -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mengecek session
        <?php if(isset($_SESSION["username"])): ?>
            alert("Session 'username' telah diset dengan nilai: <?php echo $_SESSION["username"]; ?>");
        <?php else: ?>
            alert("Session 'username' belum diset. Mungkin pengguna belum login.");
        <?php endif; ?>

        // Mengecek cookie
        <?php if(isset($_COOKIE["username"])): ?>
            alert("Cookie 'username' telah diset dengan nilai: <?php echo $_COOKIE["username"]; ?>");
        <?php else: ?>
            alert("Cookie 'username' belum diset. Mungkin pengguna belum login atau cookie telah kadaluarsa.");
        <?php endif; ?>
    });
    </script>
  </head>
  <body>
    <div class="wrapper">
    <form action="" method="post"> 
    <h1>Login</h1>
    <?php if (isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
    <div class="input-box">
        <input type="text" name="username" placeholder="Username" required /> 
        <i class="bx bx-user-circle"></i>
    </div>
    <div class="input-box">
        <input type="password" name="password" placeholder="Password" required /> 
        <i class="bx bx-lock-alt"></i>
    </div>

        <div class="remember-forget">
          <label for="">
            <input type="checkbox" />
            Remember me
          </label>
          <a href="">Forgot password?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
          <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
      </form>
    </div>
  </body>
</html>
