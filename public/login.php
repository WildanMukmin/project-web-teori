<?php
require_once __DIR__ . '/../includes/header.php';
if($is_logged_in){
    header("Location: index.php");
    exit;
}
?>

  <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
    <form action="login.php" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block text-gray-700">Username</label>
        <input type="text" id="username" name="username" required
               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
        Login
      </button>
    </form>
  </div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>