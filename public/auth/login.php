<?php
include '../../includes/db_connection.php';
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../../views/dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $query = "SELECT * FROM anggota WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: ../../views/dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        $_SESSION['error'] = "Email tidak ditemukan.";
    }

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

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

            <form method="POST" action="login.php" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-400">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-400">
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Login
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="register.php" class="text-blue-600 hover:underline">Register</a>
            </p>
        </div>
    </div>
</body>
</html>
