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

// Ambil ID tiket dari URL dan validasi
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id) || !ctype_digit($id)) {
    // Jika ID tidak valid, redirect ke halaman tiket.php
    header("Location: tiket.php");
    exit;
}

// Ambil data tiket dari database berdasarkan ID
$sql = "SELECT * FROM tiket WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Data ditemukan, ambil baris data
    $row = $result->fetch_assoc();
} else {
    // Data tidak ditemukan, redirect ke halaman tiket.php
    header("Location: tiket.php");
    exit;
}

// Proses form jika POST request diterima
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $pemesan = $_POST['pemesan'];
    $sektor = $_POST['sektor'];
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $waktu_transaksi = date('Y-m-d H:i:s', strtotime($_POST['waktu_transaksi'])); // Konversi format waktu

    // Update data di database tanpa mengubah foto
    $sql_update = "UPDATE tiket SET pemesan=?, sektor=?, tanggal_berangkat=?, waktu_transaksi=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssi", $pemesan, $sektor, $tanggal_berangkat, $waktu_transaksi, $id);

    // Eksekusi statement jika sudah didefinisikan
    if ($stmt->execute()) {
        // Jika update berhasil, redirect kembali ke halaman tiket.php
        header("Location: tiket.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi database
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Head content -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tiket</title>
    <link rel="stylesheet" href="../style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
            <span>Edit Data Tiket</span>
            <span>Admin Dashboard</span>
        </div>
        <div class="user-info">
            <div class="search">
                <i class="bx bx-search-alt"></i>
                <input type="text" placeholder="Search">
            </div>
            <img src="../image/admin.png" alt="Admin Image">
        </div>
    </div>
    <div class="form-wrapper">
        <form action="" method="post">
            <div class="form-group">
                <label for="pemesan">Pemesan</label>
                <input type="text" id="pemesan" name="pemesan" value="<?php echo htmlspecialchars($row['pemesan']); ?>">
            </div>
            <div class="form-group">
                <label for="sektor">Sektor</label>
                <input type="text" id="sektor" name="sektor" value="<?php echo htmlspecialchars($row['sektor']); ?>">
            </div>
            <div class="form-group">
                <label for="tanggal_berangkat">Tanggal Berangkat</label>
                <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="<?php echo htmlspecialchars($row['tanggal_berangkat']); ?>">
            </div>
            <div class="form-group">
                <label for="waktu_transaksi">Waktu Transaksi</label>
                <input type="datetime-local" id="waktu_transaksi" name="waktu_transaksi" value="<?php echo htmlspecialchars($row['waktu_transaksi']); ?>">
            </div>
            <button type="submit" class="move-button">Simpan Perubahan</button>
        </form>
    </div>
</div>
</body>
</html>
