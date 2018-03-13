<?php
session_start();
unset($_SESSION['email']);
session_destroy();
echo "You have been Signed out";
?>
<script> location.replace("login.php"); </script>
<?php
exit;
?>