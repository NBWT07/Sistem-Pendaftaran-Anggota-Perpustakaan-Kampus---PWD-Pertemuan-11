<?php
// NIM : 2500302054
// Nama : Naufal Basyirul Wafir Thoriq
// Pertemuan 10

require_once __DIR__ . "/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak diizinkan.");
}

// Mengambil data dari form
$no_anggota = isset($_POST['no_anggota'])
    ? trim($_POST['no_anggota']) : "";

$nama_lengkap = isset($_POST['nama_lengkap'])
    ? trim($_POST['nama_lengkap']) : "";

$email = isset($_POST['email'])
    ? trim($_POST['email']) : "";

$no_hp = isset($_POST['no_hp'])
    ? trim($_POST['no_hp']) : "";

$jenis_anggota = isset($_POST['jenis_anggota'])
    ? trim($_POST['jenis_anggota']) : "";

$alamat = isset($_POST['alamat'])
    ? trim($_POST['alamat']) : "";

$errors = array();

// Validasi data wajib diisi
if (
    empty($no_anggota) ||
    empty($nama_lengkap) ||
    empty($email) ||
    empty($no_hp) ||
    empty($jenis_anggota) ||
    empty($alamat)
) {
    $errors[] = "Semua field wajib diisi.";
}

// Validasi nomor anggota
if (!empty($no_anggota)) {
    if (!ctype_digit($no_anggota)) {
        $errors[] = "Nomor anggota hanya boleh berisi angka.";
    } elseif (strlen($no_anggota) > 15) {
        $errors[] = "Nomor anggota maksimal 15 digit.";
    }
}

// Validasi nama lengkap
if (strlen($nama_lengkap) > 100) {
    $errors[] = "Nama lengkap maksimal 100 karakter.";
}

// Validasi email
if (!empty($email)) {
    if (strlen($email) > 100) {
        $errors[] = "Email maksimal 100 karakter.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
}

// Validasi nomor HP
if (!empty($no_hp)) {
    if (!ctype_digit($no_hp)) {
        $errors[] = "Nomor HP hanya boleh berisi angka.";
    } elseif (
        strlen($no_hp) < 10 ||
        strlen($no_hp) > 13
    ) {
        $errors[] = "Nomor HP harus terdiri dari 10 sampai 13 digit.";
    }
}

// Validasi jenis anggota
$jenis_valid = array(
    "Mahasiswa",
    "Dosen",
    "Tenaga Kependidikan"
);

if (
    !in_array($jenis_anggota, $jenis_valid, true)
) {
    $errors[] = "Jenis anggota harus dipilih dengan benar.";
}

// Menampilkan pesan jika validasi gagal
if (!empty($errors)) {
    echo "<h2>Validasi Gagal</h2>";
    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }

    echo "</ul>";

    echo '<a href="form_anggota.php">Kembali ke Form</a>';
    exit;
}

// Query INSERT menggunakan prepared statement
$query = "INSERT INTO anggota
    (no_anggota, nama_lengkap, email, no_hp,
    jenis_anggota, alamat)
    VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $no_anggota,
        $nama_lengkap,
        $email,
        $no_hp,
        $jenis_anggota,
        $alamat
    );

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        header("Location: form_anggota.php?status=sukses");
        exit;

    } else {

        $pesan_error = mysqli_stmt_error($stmt);

        echo "<h2>Gagal Menyimpan Data</h2>";
        echo "<p>" .
            htmlspecialchars($pesan_error) .
            "</p>";

        mysqli_stmt_close($stmt);
    }

} else {

    echo "<h2>Gagal Menyiapkan Query</h2>";
    echo "<p>" .
        htmlspecialchars(mysqli_error($koneksi)) .
        "</p>";
}

mysqli_close($koneksi);
?>