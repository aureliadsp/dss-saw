<?php
session_start();
unset($_SESSION['email']);
session_destroy();

echo "You have been Signed out";
header("refresh: 2; url=login.php");
exit;
?>