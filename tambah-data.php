<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Tambah Data Mahasiswa</h1>
    <h2>Universitas Hamzanwadi</h2>
    <p>Silahkan masukkan data mahasiswa berdasarkan formulir berikut:</p>

    <?php
    require("koneksi.php");

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = trim($_POST["nama"]);
        $npm = trim($_POST["npm"]);
        $prodi = trim($_POST["prodi"]);
        $email = trim($_POST["email"]);
        $alamat = trim($_POST["alamat"]);

        // Validasi input tidak boleh kosong
        if (empty($nama) || empty($npm) || empty($prodi) || empty($email) || empty($alamat)) {
            $error = "Semua field harus diisi!";
        } else {
            // Simpan ke database
            $query = "INSERT INTO tbl_pelajar (npm, nama, prodi, email, alamat) 
                      VALUES ('$npm', '$nama', '$prodi', '$email', '$alamat')";
            if (mysqli_query($koneksi, $query)) {
                echo "<script>
                    alert('Data berhasil disimpan');
                    window.location.href = 'index.php';
                </script>";
                exit;
            } else {
                $error = "Gagal menyimpan data: " . mysqli_error($koneksi);
            }
        }
    }
    ?>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="" onsubmit="return validateForm()">
        <table style="width: 80%; padding: 10px;">
            <tr>
                <td style="width: 10%;"><label for="nama">Nama</label></td>
                <td><input type="text" name="nama" id="nama" required></td>
            </tr>

            <tr>
                <td><label for="npm">NPM</label></td>
                <td><input type="text" name="npm" id="npm" required></td>
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
                <td><input type="email" name="email" id="email" required></td>
            </tr>

            <tr>
                <td><label for="alamat">Alamat</label></td>
                <td><input type="text" name="alamat" id="alamat" required></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" name="submit">Tambah Data</button>
                    <button type="button" onclick="window.location.href='index.php'">Batal</button>
                </td>
            </tr>
        </table>
    </form>

    <script>
        function validateForm() {
            const nama = document.getElementById("nama").value.trim();
            const npm = document.getElementById("npm").value.trim();
            const prodi = document.getElementById("prodi").value;
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
