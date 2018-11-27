<html lang="en">
<head>
  <?php include 'head.php';
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  ?>
<link rel="stylesheet" href="../styling.css"/>
</head>
<body background="/serviceimages/bgimage3.jpg" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

  <div id="modal3" class="modal-dialog modal-lg">
  <div class="modal-content">
<div class="modal-header">
  <a href="http://v.je"><span class="glyphicon glyphicon-home"></span> Home</a>
  <h4><span class="glyphicon glyphicon-shopping-cart"></span>Shopping Cart</h4>
</div>
<div class="modal-body">

<div class="row text-center">
<?php

$cart = $pdo->prepare('SELECT * FROM cart WHERE username = :username');

$criteria = [
'username' => $_SESSION['username'],
];

$cart->execute($criteria);
?>

<table class="table" cellspacing="0" width="100%">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Service</th>
      <th scope="col">Date & Time</th>
      <th scope="col">Notes</th>
      <th scope="col">Price</th>
      <th scope="col">Employee</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $total = 0;
  foreach($cart as $items){
    // list cart data
   echo '<tr>';
   echo '<td align="left">' . $items['service'] . '</td>';
   echo '<td align="left">' . $items['booking'] . '</td>';
   echo '<td align="left">' . $items['notes'] . '</td>';
   echo '<td align="left">£' . $items['price'] . '</td>';
   echo '<td alihn="left">' . $items['employee'] . '</td>';
   echo '<td align="left"><a href="removefromcart.php?idcart= ' . $items['idcart'] . '" style="color:#B15713">Remove from Cart </a></td>';
   echo '</tr>';
   $total = $total + $items['price'];
  }
  ?>

  </tbody>
</table>


</div>
<form action="smartpayhpp256_form.php" method="POST">
  <?php
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $criteria = [
'username' => $_SESSION['username']
  ];
  $stmt->execute($criteria);
  $person = $stmt->fetch();
  $totalCash = $total*100;
  echo '<input type="hidden" name="paymentAmount" value="' . $totalCash . '">';
  echo '<input type="hidden" name="shopperEmail" value="' . $person['email'] .'">';
  echo '<input type="hidden" name="shopperID" value="' . $person['idusers'] . '">';
  ?>
  <button type="submit" value="Submit" name="submit" class="btn btn-block">Total: £<?php echo $total; ?> -- Proceed to Checkout
  <span class="glyphicon glyphicon-ok"></span>
</button>
</form>
</div>
</div></div>

<?php
}
else {
  // check for credentials
echo '<p> You are not authorised to view this page. </p>';
}

?>
</body>
