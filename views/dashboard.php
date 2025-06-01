<?php
require_once __DIR__ . '/../includes/header.php';
if(!$is_logged_in){
    header("Location: ../public/auth/login.php");
    exit;
}
?>
<?php
$user = $_SESSION['user'];

if ($role === "admin") {
    foreach ($user as $key => $value) {
        echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>";
    }
}
else if($role === "user"){
    foreach ($user as $key => $value) {
        echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>";
    }
}
?>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>