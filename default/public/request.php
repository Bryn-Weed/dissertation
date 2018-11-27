<?php
if (isset($_POST['request'])) {

$stmt = $pdo->prepare('INSERT INTO jobs(customer, service, notes, booking, status)
VALUES(:customer, :service, :notes, :booking, :status)
');

$criteria = [
  'customer' => $_SESSION['username'],
  'service' => $_POST['formService'],
  'notes' => $_POST['notes'],
  'booking' => $_POST['date'],
  'status' => $_POST['payment']
];

$stmt->execute($criteria);
}


if (isset($_POST['payment'])) {
  $price = 0;
  $date = $_POST['date'];
  $time = $_POST['time'];
  $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));





if (isset($datetime)) {
  $ste = $pdo->prepare("SELECT staff FROM jobs WHERE staff = :name AND booking = :booking");
  $criterias = [
    'name' => $_POST['employee'],
    'booking' => $datetime,
  ];
  $ste->execute($criterias);


  $stp = $pdo->prepare("SELECT employee FROM cart WHERE employee = :name AND booking = :booking AND username = :username");
  $criteriap = [
    'name' => $_POST['employee'],
    'booking' => $datetime,
    'username' => $_SESSION['username'],
  ];
  $stp->execute($criteriap);

  if ($ste->rowCount() > 0){
    $error_msg1 = "<div class='myModal1'><font color='red'>That slot is not available for the chosen employee.</font></div>";
    $script1 = "<script> $(document).ready(function(){ $('#myModal1').modal('show'); }); </script>";
  }

else if ($stp->rowCount() > 0){
  $error_msg1 = "<div class='myModal1'><font color='red'>You have already booked that slot in your cart.</font></div>";
  $script1 = "<script> $(document).ready(function(){ $('#myModal1').modal('show'); }); </script>";

}


else {
// customising request data
  $script2 = "<script> $(document).ready(function(){ $('#myModal2').modal('show'); }); </script>";

  if (isset($_POST['service']) && $_POST['service'] == 'Walk(1hr)' || $_POST['service'] == 'Training'){
    $price = 10;
  }
  else if (isset($_POST['service']) && $_POST['service'] == 'Sitting'){
    $price = 20;
  }
  else if (isset($_POST['service']) && $_POST['service'] == 'Walk(30m)'){
    $price = 8;
  }

  if (isset($_POST['requirements']) && isset($_POST['behaviour']) && isset($_POST['information'])){
    $notes = $_POST['requirements'] . ', ' . $_POST['behaviour'] . ', ' . $_POST['information'];
  }

  else if (isset($_POST['requirements']) && isset($_POST['behaviour'])){
    $notes = $_POST['requirements'] . ', ' . $_POST['behaviour'];
  }

  else if (isset($_POST['requirements']) && isset($_POST['information'])){
    $notes = $_POST['requirements'] . ', ' . $_POST['information'];
  }

  else if (isset($_POST['behaviour']) && isset($_POST['information'])){
    $notes = $_POST['behaviour'] . ', ' . $_POST['information'];
  }

$stmt1 = $pdo->prepare('INSERT INTO cart(username, service, notes, booking, status, price, employee)
VALUES(:username, :service, :notes, :booking, :status, :price, :employee)
');

$criteria1 = [
  'username' => $_SESSION['username'],
  'service' => $_POST['service'],
  'notes' => $notes,
  'booking' => $datetime,
  'status' => $_POST['payment'],
  'price' => $price,
  'employee' => $_POST['employee'],
];

$stmt1->execute($criteria1);


}
}
}

?>
