<?php
if (isset($_POST['submit'])) {
  if (isset($_POST['username'])){
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
$criteria = [
'username' => $_POST['username'],
];

$stmt->execute($criteria);
$user = $stmt->fetch();
}
// check person table for username matching the input
if (isset($_POST['password'])){
if (password_verify($_POST['password'], $user['password'])) {
 // password_verify inbuilt function to check password and hashed version of password against the one in the table
$_SESSION['loggedin'] = $user['username'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['rank'] = $user['userrank'];
$script3 = "<script> $(document).ready(function(){ $('#myModal3').modal('show'); }); </script>";

}
else {
$error_msg = "<div class='myModal'><font color='red'>Username or password is incorrect.</font></div>";
$script = "<script> $(document).ready(function(){ $('#myModal').modal('show'); }); </script>";
}
}
}


?>
