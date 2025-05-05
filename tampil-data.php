<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tampil Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table, tr, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        table {
            width: 80%;
            margin: 20px auto;
        }
        th {
            background-color: green;
            color: yellow;
        }
        h1, h2, p {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Daftar Mahasiswa</h1>
    <h2>Universitas Hamzanwadi</h2>
    <p>Berikut daftar mahasiswa Universitas Hamzanwadi, Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA)</p>
    
    <div align="center">
    <a href="tambah-data.php"> <button type="submit">Tambah Data</button> </a>
    </div>
    
    <table>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        require("koneksi.php");

        // Cek apakah tabel kosong, jika ya tambahkan data dummy
        $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tbl_pelajar");
        $jumlah = mysqli_fetch_assoc($cek)['total'];

        if ($jumlah == 0) {
            $insertData = "INSERT INTO tbl_pelajar (npm, nama, prodi, email, alamat)
                           VALUES 
                           ('1234567', 'Maria', 'Informatika', 'maria@gmail.com', 'Sakra'),
                           ('789012', 'Ulfa', 'Matematika', 'ulfa@gmail.com', 'Selong')";
            mysqli_query($koneksi, $insertData);
        }

        // Ambil data dari database
        $query = "SELECT * FROM tbl_pelajar ORDER BY idMhs DESC";
        $result = mysqli_query($koneksi, $query);

        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row["npm"]); ?></td>
                <td><?= htmlspecialchars($row["nama"]); ?></td>
                <td><?= htmlspecialchars($row["prodi"]); ?></td>
                <td><?= htmlspecialchars($row["email"]); ?></td>
                <td><?= htmlspecialchars($row["alamat"]); ?></td>
                <td>
                    <a href="ubah-data.php?idMhs=<?= $row['idMhs']; ?>">Ubah</a> |
                    <a href="hapus-data.php?idMhs=<?= $row['idMhs']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
