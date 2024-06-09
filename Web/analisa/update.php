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
    $id_tiket = $_POST['id_tiket'];
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

    // Update data in database
    if ($foto_bukti) {
        $sql = "UPDATE analisa_kepuasan SET pemesan='$pemesan', sektor='$sektor', skor_kepuasan=$skor_kepuasan, skor_customer_effort=$skor_customer_effort, foto_bukti='$foto_bukti' WHERE id_tiket=$id_tiket";
    } else {
        $sql = "UPDATE analisa_kepuasan SET pemesan='$pemesan', sektor='$sektor', skor_kepuasan=$skor_kepuasan, skor_customer_effort=$skor_customer_effort WHERE id_tiket=$id_tiket";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: analisa.php"); // Redirect to analisa.php after successfully updating data
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
