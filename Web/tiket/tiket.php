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

$sql = "SELECT * FROM tiket";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Tiket</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
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
            <li class="active">
                <a href="tiket.php">
                    <i class="bx bxs-calendar-plus"></i>
                    <span>Manajemen Tiket</span>
                </a>
            </li>
            <li>
                <a href="../analisa/input.php">
                    <i class="bx bx-archive-in"></i>
                    <span>Input Data</span>
                </a>
            </li>
            <li>
                <a href="../analisa/analisa.php">
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
                <span>Manajemen Tiket</span>
                <span>Dashboard</span>
            </div>
            <div class="user-info">
                <div class="search">
                    <i class="bx bx-search-alt"></i>
                    <input type="text" placeholder="Search" />
                </div>
                <img src="../image/ticket.png" alt="" />
            </div>
        </div>
        <div class="tabel-wrapper">
            <h3 class="main-title">Daftar Tiket</h3>
            <div class="button-container">
                <button class="move-button" onclick="window.location.href='input.php'">Input Data</button>
                <button class="move-button" onclick="window.location.href='print_tiket.php'">Print</button>
            </div>
            <div class="tabel-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Tiket</th>
                            <th>Pemesan</th>
                            <th>Sektor</th>
                            <th>Tanggal Berangkat</th>
                            <th>Waktu Transaksi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["pemesan"]; ?></td>
                                    <td><?php echo $row["sektor"]; ?></td>
                                    <td><?php echo $row["tanggal_berangkat"]; ?></td>
                                    <td><?php echo $row["waktu_transaksi"]; ?></td>
                                    <td>
                                        <div class="button-container">
                                            <a href="edit.php?id=<?php echo $row["id"]; ?>" class="edit-button">Edit</a>
                                            <a href="remove.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="remove-button">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">Total Tiket: <?php echo $result->num_rows; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
