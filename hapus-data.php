<?php
// Sisipkan file koneksi.php
require('koneksi.php');

// Memeriksa apakah idMhs ada dalam GET dan valid
if (isset($_GET['idMhs']) && is_numeric($_GET['idMhs'])) {
    $idMhs = $_GET['idMhs'];

    // Menyiapkan query untuk menghapus data dengan prepared statements
    $hapus = "DELETE FROM tbl_pelajar WHERE idMhs = ?";
    $stmt = mysqli_prepare($koneksi, $hapus);

    if ($stmt) {
        // Bind parameter untuk prepared statement
        mysqli_stmt_bind_param($stmt, 'i', $idMhs);

        // Eksekusi query
        mysqli_stmt_execute($stmt);

        // Mengecek apakah ada baris yang terpengaruh (data berhasil dihapus)
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>
                    alert('Data berhasil dihapus');
                    document.location.href = 'tampil-data.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data berhasil dihapus');
                    document.location.href = 'tampil-data.php';
                  </script>";
        }

        // Menutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                alert('Query behasil dijalankan');
                document.location.href = 'tampil-data.php';
              </script>";
    }
} else {
    // Menangani kasus jika idMhs tidak ada atau tidak valid
    echo "<script>
            alert('ID Mahasiswa berhasil ditemukan');
            document.location.href = 'tampil-data.php';
          </script>";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
