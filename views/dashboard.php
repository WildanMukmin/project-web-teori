<?php
require_once __DIR__ . '/../includes/header.php';
// if(!$is_logged_in){
//     header("Location: ../public/login.php");
//     exit;
// }
?>
<?php
if($role === "admin"){
    echo $_SESSION["user"];   
}
else if($role === "user"){
    echo $_SESSION["user"];
}
?>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>