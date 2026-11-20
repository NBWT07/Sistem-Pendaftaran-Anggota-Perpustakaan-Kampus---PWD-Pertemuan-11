<?php
// NIM : 2500302054
// Nama : Naufal Basyirul Wafir Thoriq
// Pertemuan 10

$pesan = "";

if (isset($_GET['status']) && $_GET['status'] == "sukses") {
    $pesan = "Pendaftaran anggota berhasil disimpan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Form Pendaftaran Anggota Perpustakaan</h2>

    <?php if ($pesan != "") { ?>
        <p style="color: green;">
            <?php echo htmlspecialchars($pesan); ?>
        </p>
    <?php } ?>

    <form action="proses_anggota.php" method="POST">

        <label>Nomor Anggota:</label><br>
        <input type="text" name="no_anggota"
               maxlength="15" required><br><br>

        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap"
               maxlength="100" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"
               maxlength="100" required><br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="no_hp"
               maxlength="13" required><br><br>

        <label>Jenis Anggota:</label><br>
        <select name="jenis_anggota" required>
            <option value="">-- Pilih Jenis Anggota --</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Dosen">Dosen</option>
            <option value="Tenaga Kependidikan">
                Tenaga Kependidikan
            </option>
        </select><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <button type="submit">Daftar Anggota</button>

    </form>

</body>
</html>