<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
// sisipkan file koneksi
require('koneksi.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penerimaan Siswa Baru</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>SELAMAT DATANG </h1>

    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <h2>SISTEM PENERIMAN SISWA BARU</h2>
            <h3>SMPN NEGERI 5 SELONG</h3>

            <a class="navbar-brand" href="#"> ASPMB</a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link"
                           aria-current="page"
                           href="index.php">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active"
                           aria-current="page"
                           href="login.php">
                            Login
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <h2>Formulir Pembuatan Akun  </h2>

    <div>
        <form action="">

            <label for="username">Username:</label><br>
            <input type="text"
                   id="username"
                   name="username"><br><br>

            <label for="password">Kata Sandi:</label><br>
            <input type="password"
                   id="password"
                   name="password"><br><br>

            <label for="email">Email:</label><br>
            <input type="email"
                   id="email"
                   name="email"><br><br>

            <input type="submit"
                   value="Buat Akun"
                   name="login"><br>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>