<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "pengaduan_keluhan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi = $_POST['deskripsi'];

    // Check if file is uploaded
    if(isset($_FILES['foto_dokumen']) && $_FILES['foto_dokumen']['error'] === UPLOAD_ERR_OK) {
        $foto_dokumen = $_FILES['foto_dokumen']['name']; // Get the file name
        $foto_dokumen_tmp = $_FILES['foto_dokumen']['tmp_name']; // Get the temporary file path
        
        // Move the file to the desired location
        $upload_directory = "../foto/";
        if(move_uploaded_file($foto_dokumen_tmp, $upload_directory.$foto_dokumen)) {
            echo "File uploaded successfully.";
        } else {
            echo "Failed to upload file.";
        }
    } else {
        // No file uploaded or an error occurred
        $foto_dokumen = null;
    }

    // Insert data into database
    $sql = "INSERT INTO keluhan (deskripsi, foto_dokumen) VALUES ('$deskripsi', '$foto_dokumen')";
    if ($conn->query($sql) === TRUE) {
        header("Location: keluhan.php"); // Redirect to keluhan.php after successfully saving data
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data</title>
    <link rel="stylesheet" href="../style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li><a href="../admin.php"><i class="bx bxs-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="keluhan.php"><i class="bx bxs-objects-vertical-bottom"></i><span>Pengaduan dan Keluhan</span></a></li>
            <li class="active"><a href="input.php"><i class="bx bx-notepad"></i><span>Input Data</span></a></li>
            <li><a href="../Petisi/petisi.php"><i class="bx bxs-message-dots"></i><span>Petisi dan Kampanye</span></a></li>
            <li><a href="#"><i class="bx bxs-log-out"></i><span>Logout</span></a></li>
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
                    <input type="text" placeholder="Search">
                </div>
                <img src="../image/government64px.png" alt="">
            </div>
        </div>
        <div class="tabel-wrapper">
            <h3 class="main-title">Input Data</h3>
            <div class="form-wrapper">
                <form action="input.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_dokumen">Foto Dokumen</label>
                        <input type="file" id="foto_dokumen" name="foto_dokumen">
                    </div>
                    <div class="button-container">
                        <button class="move-button" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
