<?php
require_once __DIR__ . '/../includes/header.php';
// if(!$is_logged_in){
//     header("Location: ../public/login.php");
//     exit;
// }
?>
<?php
if($role === "admin"){
    echo "dashboard admin";
}
else if($role === "user"){
    echo "dashboard user";
}
else{
    echo "dashboard guest";
}
?>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>