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

// Proses penghapusan data jika tombol "Remove" diklik
if (isset($_POST['id_remove'])) {
    $id_remove = $_POST['id_remove'];

    // Buat kueri SQL untuk menghapus data
    $sql_delete = "DELETE FROM petisi WHERE id = '$id_remove'";

    // Eksekusi kueri
    if ($conn->query($sql_delete) === TRUE) {
        // Data berhasil dihapus, redirect kembali ke halaman petisi.php
        header("Location: petisi.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Tabel untuk menampilkan data petisi -->
    <div class="tabel-wrapper">
        <div class="tabel-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lakukan iterasi untuk setiap baris data yang diterima dari hasil query
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["judul"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            // Tombol Remove akan mengarahkan pengguna ke remove.php dengan ID petisi sebagai parameter
                            echo "<td><a href=\"remove.php?id_remove=" . $row["id"] . "\" onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Remove</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        // Jika tidak ada data petisi, tampilkan pesan
                        echo "<tr><td colspan='4'>Tidak ada data petisi</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
