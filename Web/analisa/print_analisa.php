<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

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

// Membuat objek Dompdf
$dompdf = new Dompdf();

// Mengatur HTML yang akan dicetak
$html = "<html><body>";
$html .= "<h1>Analisa Kepuasan</h1>";
$html .= "<table border='1' cellspacing='0' cellpadding='10'>";
$html .= "<thead>";
$html .= "<tr>";
$html .= "<th>ID Tiket</th>";
$html .= "<th>Pemesan</th>";
$html .= "<th>Sektor</th>";
$html .= "<th>Foto Bukti</th>";
$html .= "<th>Skor Kepuasan</th>";
$html .= "<th>Skor Customer Effort</th>";
$html .= "<th>Status</th>";
$html .= "</tr>";
$html .= "</thead>";
$html .= "<tbody>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $html .= "<tr>";
        $html .= "<td>" . htmlspecialchars($row["id_tiket"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["pemesan"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["sektor"]) . "</td>";
        $html .= "<td>";
        if ($row["foto_bukti"]) {
            $html .= "<img src='../uploads/" . basename($row["foto_bukti"]) . "' alt='Foto bukti' style='width: 100px;'>";
        } else {
            $html .= "Tidak ada foto";
        }
        $html .= "</td>";
        $html .= "<td>" . htmlspecialchars($row["skor_kepuasan"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["skor_customer_effort"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["status"]) . "</td>";
        $html .= "</tr>";
    }
} else {
    $html .= "<tr><td colspan='7'>Tidak ada data</td></tr>";
}

$html .= "</tbody>";
$html .= "</table>";
$html .= "</body></html>";

// Memasukkan HTML ke Dompdf
$dompdf->loadHtml($html);

// Mengatur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');

// Render PDF
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("analisa_kepuasan.pdf", array("Attachment" => false));

// Tutup koneksi database
$conn->close();
?>
