<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "paundra";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pemesan = isset($_POST['pemesan']) ? $_POST['pemesan'] : '';
    $sektor = isset($_POST['sektor']) ? $_POST['sektor'] : '';
    $skor_kepuasan = isset($_POST['skor_kepuasan']) ? (int)$_POST['skor_kepuasan'] : 0;
    $skor_customer_effort = isset($_POST['skor_customer_effort']) ? (int)$_POST['skor_customer_effort'] : 0;

    // Check if file is uploaded
    if(isset($_FILES['foto_bukti']) && $_FILES['foto_bukti']['error'] === UPLOAD_ERR_OK) {
        $foto_bukti = $_FILES['foto_bukti']['name']; // Get the file name
        $foto_bukti_tmp = $_FILES['foto_bukti']['tmp_name']; // Get the temporary file path
        
        // Move the file to the desired location
        $upload_directory = "../uploads/";
        if(move_uploaded_file($foto_bukti_tmp, $upload_directory.$foto_bukti)) {
            echo "File uploaded successfully.";
        } else {
            echo "Failed to upload file.";
        }
    } else {
        // No file uploaded or an error occurred
        $foto_bukti = null;
    }

    // Insert data into database
    $sql = "INSERT INTO analisa_kepuasan (pemesan, sektor, skor_kepuasan, skor_customer_effort, foto_bukti) VALUES ('$pemesan', '$sektor', $skor_kepuasan, $skor_customer_effort, '$foto_bukti')";
    if ($conn->query($sql) === TRUE) {
        header("Location: analisa.php"); // Redirect to keluhan.php after successfully saving data
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Input Data</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="admin.php">
                    <i class="bx bxs-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../tiket/tiket.php">
                    <i class="bx bxs-calendar-plus"></i>
                    <span>Manajemen Tiket</span>
                </a>
            </li>
            <li class="active">
                <a href="analisa/input.php">
                    <i class="bx bx-archive-in"></i>
                    <span>Input Data</span>
                </a>
            </li>
            <li>
                <a href="analisa.php">
                    <i class="bx bx-bar-chart-square"></i>
                    <span>Analisis</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-log-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <span>Input Data</span>
                <span>Dashboard</span>
            </div>
            <div class="user-info">
                <div class="search">
                    <i class="bx bx-search-alt"></i>
                    <input type="text" placeholder="Search" />
                </div>
                <img src="../image/rating.png" alt="" />
            </div>
        </div>
        <div class="tabel-wrapper">
            <h3 class="main-title">Input Data</h3>
            <div class="form-wrapper">
                <form action="input.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="pemesan">Pemesan</label>
                        <input type="text" id="pemesan" name="pemesan" />
                    </div>
                    <div class="form-group">
                        <label for="sektor">Sektor</label>
                        <input type="text" id="sektor" name="sektor" />
                    </div>
                    <div class="form-group">
                        <label for="skor_kepuasan">Skor Kepuasan</label>
                        <input type="text" id="skor_kepuasan" name="skor_kepuasan" />
                    </div>
                    <div class="form-group">
                        <label for="skor_customer_effort">Skor Customer Effort</label>
                        <input type="text" id="skor_customer_effort" name="skor_customer_effort" />
                    </div>
                    <div class="form-group">
                        <label for="foto_bukti">Foto Dokumen</label>
                        <input type="file" id="foto_bukti" name="foto_bukti">
                    </div>
                    <div class="button-container">
                        <button type="submit" class="move-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

