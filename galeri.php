<?php
include 'includes/config.php';

if (isset($_POST['submit'])) {

    if ($_FILES['image']['size'] > 20 * 1024 * 1024) { // 20MB
        echo "File terlalu besar!";
        exit();
    }

    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    // Cek apakah gambar sudah ada di server
    if (file_exists($target)) {
        echo "Gambar sudah ada!";
    } else {
        // Upload gambar ke server
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO images (image_name, image_path) VALUES ('$image', '$target')";
            if ($conn->query($sql) === TRUE) {
                header("Location: galeri.php"); // Redirect untuk menghindari duplikasi setelah upload
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TKJ SMKN 1 Takisung - Explore the Future of Networking</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsif.css">
    <link rel="stylesheet" href="css/miring.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="img/tkj.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
    <section id="galeri">
        <header>
           <div class="main-container">
               <div class="bg">
                   <div class="logo1">
                       TKJ<span>21</span>
                   </div>
                   <nav class="navi">
                       <div class="logo">
                           TKJ<span>21</span>
                       </div>
                       <ul>
                           <li><a href="index.html" class="active">Beranda</a></li>
                           <li><a href="alumni.html">Alumni</a></li>
                           <li><a href="galeri.php">Galeri</a></li>
                           <li><a href="kontak.html">Kontak</a></li>
                           <li><a href="lainnya.php">Lainnya</a></li>
                       </ul>
                   </nav>
                   <div class="burger">
                       <div class="line-1"></div>
                       <div class="line-2"></div>
                       <div class="line-3"></div>
                   </div>
               </div>
           </div>
        </header>

        <div class="container mt-5">
            <h2 class="text-center">Galeri</h2>
            <form method="POST" action="galeri.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
            </form>

            <h3 class="mt-5 text-center">Kenangan Kami</h3>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-4">
                        <div class="card mb-4" data-aos="zoom-in">
                            <img src="<?php echo $row['image_path']; ?>" class="card-img-top image-preview" alt="<?php echo $row['image_name']; ?>" style="height: 300px; object-fit: cover;" data-image-path="<?php echo $row['image_path']; ?>">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm view-image" data-image-path="<?php echo $row['image_path']; ?>">Lihat Gambar</a>
                                <a href="<?php echo $row['image_path']; ?>" download class="btn btn-success btn-sm">Download</a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="showDeleteModal(<?php echo $row['id']; ?>)">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <footer>
        <p>©2025 - TKJ SMKN 1 TAKISUNG <br>
            Build with HTML, CSS, and JavaScript
    </p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
