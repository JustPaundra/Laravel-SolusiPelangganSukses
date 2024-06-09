<?php
$servername = "localhost"; // Ganti jika server database Anda berbeda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "paundra"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$pemesan = $_POST['pemesan'];
$sektor = $_POST['sektor'];
$tanggal_berangkat = $_POST['tanggal_berangkat'];
$waktu_transaksi = $_POST['waktu_transaksi'];
$status = 'pending'; // Set status awal sebagai 'pending'

// Buat query
$sql = "INSERT INTO tiket (pemesan, sektor, tanggal_berangkat, status, waktu_transaksi) VALUES ('$pemesan', '$sektor', '$tanggal_berangkat', '$status', '$waktu_transaksi')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect kembali ke halaman utama atau halaman lain
header("Location: index.php");
exit();
?>
