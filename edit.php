<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $imagePath = $row['image_path'];

    // Mengatur ukuran gambar (misalnya menjadi 300x300)
    if (isset($_POST['submit'])) {
        $newWidth = $_POST['width'];
        $newHeight = $_POST['height'];

        list($originalWidth, $originalHeight) = getimagesize($imagePath);
        $image = imagecreatefromjpeg($imagePath);
        $resizedImage = imagescale($image, $newWidth, $newHeight);
        imagejpeg($resizedImage, $imagePath);
        imagedestroy($image);
        imagedestroy($resizedImage);

        echo "Gambar berhasil diubah ukurannya!";
        header("Location: galeri.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Ukuran Gambar</h2>
    <form method="POST" action="edit.php?id=<?php echo $id; ?>">
        <div class="mb-3">
            <label for="width" class="form-label">Lebar</label>
            <input type="number" name="width" class="form-control" value="300" required>
        </div>
        <div class="mb-3">
            <label for="height" class="form-label">Tinggi</label>
            <input type="number" name="height" class="form-control" value="300" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
