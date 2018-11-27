<?php
if (isset($_POST['query'])) {

$stmt = $pdo->prepare('INSERT INTO enquiries(name, email, comments)
VALUES(:name, :email, :comments)
');

$criteria = [
  'name' => $_POST['queryname'],
  'email' => $_POST['queryemail'],
  'comments' => $_POST['querycomments'],
];

$stmt->execute($criteria);
}


?>
