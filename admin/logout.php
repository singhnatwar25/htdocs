<!-- logout session destroy -->
<?php
session_start();
session_destroy();
header('location:index.php');
?>

