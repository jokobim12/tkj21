<?php
include 'includes/config.php';
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
    <section id="lainnya">
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
    <div class="container py-5">
        <h2 class="j-lainnya">Silahkan berkomentar</h2>

        <!-- Form Komentar -->
        <form method="POST" action="submit_comment.php" class="mb-4">
            <input type="hidden" name="parent_id" value="0">
            <div class="mb-2">
                <input type="text" name="name" class="form-control" placeholder="nama" required>
            </div>
            <div class="mb-2">
                <textarea name="content" class="form-control" placeholder="tulis komentarmu..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">kirim komentar</button>
        </form>

        <hr>

        <!-- Tampilkan Komentar -->
        <div class="mt-4">
        <?php
        function tampilkanKomentar($parent_id = 0, $level = 0) {
            global $conn;
            $sql = "SELECT * FROM comments WHERE parent_id = $parent_id ORDER BY created_at ASC";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="mb-3" style="margin-left:' . ($level * 20) . 'px;">';
                echo '<div class="border rounded p-3">';
                echo '<strong class="text-primary">' . htmlspecialchars($row['name']) . '</strong><br>';
                echo '<p class="mb-2">' . nl2br(htmlspecialchars($row['content'])) . '</p>';
                echo '<a href="#" class="reply-btn btn btn-sm btn-link px-0" data-id="' . $row['id'] . '">Balas</a>';
                echo '<a href="hapus_comment.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger ms-2" onclick="return confirm(\'Yakin ingin menghapus komentar ini?\')">Hapus</a>';


                // Form Balasan
                echo '<form method="POST" action="submit_comment.php" class="reply-form d-none mt-2" id="reply-form-' . $row['id'] . '">
                        <input type="hidden" name="parent_id" value="' . $row['id'] . '">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Nama kamu" required>
                        <textarea name="content" class="form-control mb-2" placeholder="Tulis balasan..." required></textarea>
                        <button type="submit" class="btn btn-secondary btn-sm">Kirim Balasan</button>
                      </form>';
                
                echo '</div>';
                tampilkanKomentar($row['id'], $level + 1);
                echo '</div>';
            }
        }

        tampilkanKomentar();
        ?>
        </div>
    </div>
</section>
   <footer>
        <p>©2025 - TKJ SMKN 1 TAKISUNG <br>
            Build with HTML, CSS, and JavaScript
    </p>
    </footer>
    <script src="js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".reply-btn").forEach(function (btn) {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                const id = this.getAttribute("data-id");
                document.getElementById("reply-form-" + id).classList.toggle("d-none");
            });
        });
    });
    </script>
</body>
</html>
