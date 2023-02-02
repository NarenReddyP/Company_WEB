<?php
ob_start();
session_start();
session_destroy();
header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/logandreg.php");
?>

<?php
/*
ob_start();
session_start();
if(isset($_SESSION['UserName'])) {
session_destroy();

unset($_SESSION['UserName']);
unset($_SESSION['Email']);
unset($_SESSION['Mobile']);
header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/logandreg.php");
} else {
header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/logandreg.php");
}
*/
?>
