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

$sql = "SELECT * FROM analisa_kepuasan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Analisa</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
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
            <li>
                <a href="input.php">
                    <i class="bx bx-archive-in"></i>
                    <span>Input Data</span>
                </a>
            </li>
            <li class="active">
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
                <span>Analisa Kepuasan</span>
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
            <h3 class="main-title">Analisa Kepuasan</h3>
            <div class="button-container">
                <button class="move-button" onclick="window.location.href='input.php'">Input Data</button>
                <button class="move-button" onclick="window.location.href='print_analisa.php'">Print</button>
            </div>
            <div class="tabel-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Tiket</th>
                            <th>Pemesan</th>
                            <th>Sektor</th>
                            <th>Foto Bukti</th>
                            <th>Skor Kepuasan</th>
                            <th>Skor Customer Effort</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row["id_tiket"]; ?></td>
                                    <td><?php echo $row["pemesan"]; ?></td>
                                    <td><?php echo $row["sektor"]; ?></td>
                                    <td>
                                        <?php if ($row["foto_bukti"]): ?>
                                            <img src="../uploads/<?php echo basename($row["foto_bukti"]); ?>" alt="Foto bukti" style="width: 100px;">
                                        <?php else: ?>
                                            Tidak ada foto
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row["skor_kepuasan"]; ?></td>
                                    <td><?php echo $row["skor_customer_effort"]; ?></td>
                                    <td>
                                        <span class="status status-<?php echo strtolower($row["status"]); ?>">
                                            <?php echo $row["status"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="button-container">
                                            <a href="edit.php?id_tiket=<?php echo $row["id_tiket"]; ?>" class="edit-button">Edit</a>
                                            <a href="remove.php?id_tiket=<?php echo $row['id_tiket']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="remove-button">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">Total Task: <?php echo $result->num_rows; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
