<?php
require_once __DIR__ . "/id.php";

function cekRegistrasi($username)
{
    global $koneksi;

    if (!isset($koneksi) || !$koneksi) {
        return 0;
    }

    $stmt = mysqli_prepare($koneksi, "SELECT id FROM tbl_pendaftaran WHERE username = ?");
    if (!$stmt) {
        return 0;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $jumlah = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    return $jumlah > 0 ? 1 : 0;
}

function registrasi($data)
{
    global $koneksi;

    if (!isset($koneksi) || !$koneksi) {
        return ["status" => false, "message" => "Koneksi database tidak tersedia."];
    }

    $username = isset($data["username"]) ? trim($data["username"]) : "";
    $namaDepan = isset($data["namaDepan"]) ? trim($data["namaDepan"]) : "";
    $namaBelakang = isset($data["namaBelakang"]) ? trim($data["namaBelakang"]) : "";
    $tempatLahir = isset($data["tempatLahir"]) ? trim($data["tempatLahir"]) : "";
    $tglLahir = isset($data["tglLahir"]) ? trim($data["tglLahir"]) : "";
    $jenisKelamin = isset($data["jenisKelamin"]) ? trim($data["jenisKelamin"]) : "";
    $nisn = isset($data["nisn"]) ? trim($data["nisn"]) : "";
    $agama = isset($data["agama"]) ? trim($data["agama"]) : "";
    $sekolahAsal = isset($data["sekolahAsal"]) ? trim($data["sekolahAsal"]) : "";
    $alamat = isset($data["alamat"]) ? trim($data["alamat"]) : "";
    $namaOrtu = isset($data["namaOrtu"]) ? trim($data["namaOrtu"]) : "";
    $telpon = isset($data["telpon"]) ? trim($data["telpon"]) : "";

    if ($username === "") {
        return ["status" => false, "message" => "Username wajib diisi."];
    }

    $tableCheck = mysqli_query($koneksi, "SHOW TABLES LIKE 'tbl_pendaftaran'");
    if (mysqli_num_rows($tableCheck) === 0) {
        $sql = "CREATE TABLE tbl_pendaftaran (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            nama_depan VARCHAR(100) NOT NULL,
            nama_belakang VARCHAR(100) DEFAULT NULL,
            tempat_lahir VARCHAR(100) DEFAULT NULL,
            tgl_lahir DATE DEFAULT NULL,
            jenis_kelamin VARCHAR(20) DEFAULT NULL,
            nisn VARCHAR(20) DEFAULT NULL,
            agama VARCHAR(50) DEFAULT NULL,
            sekolah_asal VARCHAR(150) DEFAULT NULL,
            alamat TEXT DEFAULT NULL,
            nama_ortu VARCHAR(200) DEFAULT NULL,
            telpon VARCHAR(30) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if (!mysqli_query($koneksi, $sql)) {
            return ["status" => false, "message" => "Gagal membuat tabel pendaftaran: " . mysqli_error($koneksi)];
        }
    }

    if (cekRegistrasi($username) > 0) {
        return ["status" => false, "message" => "Anda sudah mengisi formulir."];
    }

    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO tbl_pendaftaran (username, nama_depan, nama_belakang, tempat_lahir, tgl_lahir, jenis_kelamin, nisn, agama, sekolah_asal, alamat, nama_ortu, telpon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        return ["status" => false, "message" => "Gagal menyiapkan query: " . mysqli_error($koneksi)];
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssss",
        $username,
        $namaDepan,
        $namaBelakang,
        $tempatLahir,
        $tglLahir,
        $jenisKelamin,
        $nisn,
        $agama,
        $sekolahAsal,
        $alamat,
        $namaOrtu,
        $telpon
    );

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ["status" => false, "message" => "Gagal menyimpan data: " . mysqli_error($koneksi)];
    }

    mysqli_stmt_close($stmt);

    return ["status" => true, "message" => "Registrasi berhasil disimpan."];
}
?>
