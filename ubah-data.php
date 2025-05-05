<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Ubah Data Mahasiswa</h1>
<h2>Universitas Hamzanwadi</h2>
<p>Silakan ubah data mahasiswa:</p>

<?php
require("koneksi.php");

// Validasi parameter idMhs
if (!isset($_GET["idMhs"]) || !is_numeric($_GET["idMhs"])) {
    echo "<script>alert('ID Mahasiswa tidak valid.'); window.location.href = 'tampil-data.php';</script>";
    exit;
}

$idMhs = (int)$_GET["idMhs"];

// Ambil data mahasiswa berdasarkan idMhs
$dataUbah = "SELECT * FROM tbl_pelajar WHERE idMhs = $idMhs";
$lihatUbah = mysqli_query($koneksi, $dataUbah);
$data = mysqli_fetch_assoc($lihatUbah);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href = 'tampil-data.php';</script>";
    exit;
}
?>

<form action="" method="POST" onsubmit="return validateForm()">
    <table style="width: 80%; padding: 10px;">
        <tr>
            <td style="width: 10%;"><label for="nama">Nama</label></td>
            <td><input type="text" name="nama" id="nama" value="<?= htmlspecialchars($data['nama']) ?>"></td>
        </tr>
        <tr>
            <td><label for="npm">NPM</label></td>
            <td><input type="text" name="npm" id="npm" value="<?= htmlspecialchars($data['npm']) ?>"></td>
        </tr>
        <tr>
        <td><label for="prodi">Program Studi</label></td>
                <td>
                    <select name="prodi" id="prodi" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="Pendidikan Informatika">Pendidikan Informatika</option>
                        <option value="Pendidikan Matematika">Pendidikan Matematika</option>
                        <option value="Pendidikan Biologi">Pendidikan Biologi</option>
                        <option value="Pendidikan Fisika">Pendidikan Fisika</option>
                        <option value="Pendidikan IPA">Pendidikan IPA</option>
                        <option value="Statistika">Statistika</option>
                    </select>
            </td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" id="email" value="<?= htmlspecialchars($data['email']) ?>"></td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td><input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($data['alamat']) ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="submit">Ubah Data</button>
                <button type="button" onclick="window.location.href = 'index.php'">Batal</button>
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST["submit"])) {
    // Tangkap data dari form dan sanitasi
    $nama   = mysqli_real_escape_string($koneksi, trim($_POST["nama"]));
    $npm    = mysqli_real_escape_string($koneksi, trim($_POST["npm"]));
    $prodi  = mysqli_real_escape_string($koneksi, trim($_POST["prodi"]));
    $email  = mysqli_real_escape_string($koneksi, trim($_POST["email"]));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST["alamat"]));

    // Validasi server-side
    if ($nama && $npm && $prodi && $email && $alamat) {
        $ubahData = "UPDATE tbl_pelajar SET
            npm = '$npm',
            nama = '$nama',
            prodi = '$prodi',
            email = '$email',
            alamat = '$alamat'
            WHERE idMhs = $idMhs";

        mysqli_query($koneksi, $ubahData);
        $hasilUbah = mysqli_affected_rows($koneksi);

        if ($hasilUbah > 0) {
            echo "<script>
                alert('Data berhasil diubah.');
                window.location.href = 'tampil-data.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah.');
                window.location.href = 'tampil-data.php';
            </script>";
        }
    } else {
        echo "<script>alert('Semua field wajib diisi.');</script>";
    }
}
?>

<script>
function validateForm() {
    const nama = document.getElementById("nama").value.trim();
    const npm = document.getElementById("npm").value.trim();
    const prodi = document.getElementById("prodi").value.trim();
    const email = document.getElementById("email").value.trim();
    const alamat = document.getElementById("alamat").value.trim();

    if (!nama || !npm || !prodi || !email || !alamat) {
        alert("Semua field wajib diisi.");
        return false;
    }
    return true;
}
</script>

</body>
</html>