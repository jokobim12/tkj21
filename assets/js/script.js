let imagesArray = []; // Array untuk menyimpan gambar
let currentIndex = 0; // Untuk melacak gambar yang sedang ditampilkan

// Fungsi untuk menampilkan gambar besar dalam modal
function viewImage(imagePath) {
    console.log('Viewing image:', imagePath);

    // Buat elemen modal secara dinamis
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.id = 'imageModal';

    // Struktur konten modal
    const modalContent = `
        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="${imagePath}" class="modal-image">
        </div>
    `;
    modal.innerHTML = modalContent;

    // Menambahkan modal ke body
    document.body.appendChild(modal);

    // Menutup modal saat tombol 'X' diklik
    modal.querySelector('.close').addEventListener('click', function() {
        document.body.removeChild(modal);
    });
}

// Menyimpan semua gambar yang di-upload dalam array untuk navigasi
document.addEventListener('DOMContentLoaded', function() {
    // Memilih tombol untuk melihat gambar
    const images = document.querySelectorAll('.view-image');
    
    images.forEach((button) => {
        button.addEventListener('click', function() {
            const imagePath = this.getAttribute('data-image-path');  // Ambil data-image-path yang berisi path gambar
            console.log('Image clicked:', imagePath);  // Memastikan path gambar yang diklik benar
            viewImage(imagePath); // Menampilkan gambar yang diklik dalam modal
        });
    });

    // Menyimpan semua gambar dalam array untuk prev/next navigation

});


// Fungsi untuk menampilkan modal konfirmasi password
function showDeleteModal(imageId) {
    const deleteModal = document.createElement('div');
    deleteModal.className = 'delete-modal';
    
    const modalContent = `
        <div class="delete-modal-content">
            <h4>Konfirmasi Penghapusan</h4>
            <p>password bisa dm admin @execut.algorithm</p>
            <input type="password" id="password" placeholder="Masukkan password" class="form-control" required>
            <button class="btn btn-danger" onclick="deleteImage(${imageId})">Hapus</button>
            <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
        </div>
    `;
    deleteModal.innerHTML = modalContent;
    document.body.appendChild(deleteModal);
}

// Fungsi untuk menutup modal
function closeDeleteModal() {
    document.querySelector('.delete-modal').remove();
}

// Fungsi untuk menghapus gambar setelah verifikasi password
function deleteImage(imageId) {
    const password = document.getElementById('password').value;
    
    // Verifikasi password (ganti 'adminpassword' dengan password yang Anda inginkan)
    if (password === 'viscabarca') {
        // Kirim permintaan untuk menghapus gambar jika password benar
        window.location.href = `delete.php?id=${imageId}&password=${password}`;
    } else {
        alert('Password salah! Gambar tidak dapat dihapus.');
    }
}
