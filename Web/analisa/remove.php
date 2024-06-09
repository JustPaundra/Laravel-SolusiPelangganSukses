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

if (isset($_GET['id_tiket'])) {
    $id_tiket = $_GET['id_tiket'];

    // Hapus data dari database
    $sql = "DELETE FROM analisa_kepuasan WHERE id_tiket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_tiket);

    if ($stmt->execute()) {
        header("Location: analisa.php"); // Redirect to analisa.php after successfully deleting data
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID Tiket tidak ditemukan!";
}

$conn->close();
?>
