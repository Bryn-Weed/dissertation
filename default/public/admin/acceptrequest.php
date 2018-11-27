<?php

include '../head.php';

// Grabbing relevant data to user and converting into variables
$jobs = $pdo->prepare('SELECT * FROM requests WHERE idrequests = :idvar');

$criteria = [
'idvar' => $_GET['idrequests'],
];

$jobs->execute($criteria);

foreach($jobs as $job){
  $output1 = $job['username'];
  $output2 = $job['service'];
  $output3 = $job['booking'];
  $output4 = $job['notes'];
  $output5 = $job['status'];
}

// using the variables to transfer user data from requests table to jobs
$newjob = $pdo->prepare('INSERT INTO jobs(customer, service, booking, notes, staff, status)
VALUES(:customer, :service, :booking, :notes, :staff, :status)
');

$criteria1 = [
'customer' => $output1,
'service' => $output2,
'booking' => $output3,
'notes' => $output4,
'staff' => $_SESSION['username'],
'status' => $output5,
];

$newjob->execute($criteria1);

// removing the data from the old requests table
$deleterequest = $pdo->prepare('DELETE FROM requests WHERE idrequests = :idvar');

$criteria2 = [
  'idvar' => $_GET['idrequests'],
];

$deleterequest->execute($criteria2);

header("Location: /admin/index.php");
