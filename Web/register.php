<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $users = isset($_SESSION['users']) ? $_SESSION['users'] : [];

        $users[] = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT) 
        ];

        $_SESSION['users'] = $users;

        header("Location: login.php");
        exit;
    } else {
        $register_error = "Password dan konfirmasi password tidak cocok.";
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>register</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style/register.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="wrapper">
    <form action="register.php" method="post">
        <h1>Daftar Akun</h1>
        <?php if (isset($register_error)) echo "<p style='color:red;'>$register_error</p>"; ?>
        <div class="input-box">
          <div class="input-field">
            <input type="text" name="nama_lengkap"  placeholder="Nama Lengkap" required />
            <i class="bx bx-user-circle"></i>
          </div>
          <div class="input-field">
            <input type="email" name="email" placeholder="Email" required />
            <i class="bx bxl-gmail"></i>
          </div>
        </div>
        <div class="input-box">
          <div class="input-field">
            <input type="password" name="password" placeholder="Password" required />
            <i class="bx bx-lock"></i>
          </div>
          <div class="input-field">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required />
            <i class="bx bx-lock"></i>
          </div>
        </div>
        <label for=""
          ><input type="checkbox" />Dengan ini saya menyatakan bahwa informasi
          diatas benar dan tepat</label
        >
        <button type="submit" class="btn">Register</button>
      </form>
    </div>
  </body>
</html>
