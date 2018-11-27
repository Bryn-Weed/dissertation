<?php

include 'head.php';
// delete item from cart table
$deletecart = $pdo->prepare('DELETE FROM cart WHERE idcart = :idvar');

$criteria2 = [
  'idvar' => $_GET['idcart'],
];

$deletecart->execute($criteria2);

header("Location: /cart.php");

?>
