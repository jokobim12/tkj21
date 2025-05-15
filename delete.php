<?php
include 'includes/config.php';

if (isset($_GET['id']) && isset($_GET['password'])) {
    $id = $_GET['id'];
    $password = $_GET['password'];

    // Verifikasi password (ganti dengan password yang sesuai)
    if ($password === 'viscabarca') {
        // Dapatkan path gambar dari database
        $sql = "SELECT image_path FROM images WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $imagePath = $row['image_path'];

        // Hapus gambar dari server
        if (unlink($imagePath)) {
            // Hapus data gambar dari database
            $sql = "DELETE FROM images WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Gambar berhasil dihapus!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Password salah!";
    }
}

header("Location: galeri.php"); // Redirect kembali ke halaman utama
?>
