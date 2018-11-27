<?php




session_start();
session_destroy();
// destroys session and redirects to index.php, dynamic head.php links return to normal
header("Location: index.php");

?>
