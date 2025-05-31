<?php
include '../../includes/db_connection.php';
session_start();

if (isset($_SESSION['user'])) {
    header("Location: ../../views/dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $nomor = mysqli_real_escape_string($conn, trim($_POST['nomor']));
    $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));

    // Validasi data tidak kosong (opsional tambahan)
    if (empty($nama) || empty($email) || empty($_POST['password']) || empty($nomor) || empty($alamat)) {
        $_SESSION['error'] = "Semua field wajib diisi.";
        header("Location: register.php");
        exit;
    }

    $checkQuery = "SELECT * FROM anggota WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error'] = "Email sudah terdaftar.";
        header("Location: register.php");
        exit;
    }

    $insertQuery = "INSERT INTO anggota (nama, email, password, nomor, alamat) 
                    VALUES ('$nama', '$email', '$password', '$nomor', '$alamat')";

    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
        header("Location: register.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="register.php" class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-green-300 focus:border-green-400">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-green-300 focus:border-green-400">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-green-300 focus:border-green-400">
                </div>

                <div>
                    <label for="nomor" class="block text-sm font-medium text-gray-700">Nomor</label>
                    <input type="text" name="nomor" id="nomor" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-green-300 focus:border-green-400">
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-green-300 focus:border-green-400">
                </div>

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="login.php" class="text-green-600 hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>
