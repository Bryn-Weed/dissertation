<?php

include '../head.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Including the PHPMailer class to use on Localhost -- PHP MAILER DOES NOT BELONG TO ME

require '../include/PHPMailer-master/src/Exception.php';
require '../include/PHPMailer-master/src/PHPMailer.php';
require '../include/PHPMailer-master/src/SMTP.php';

$jobs = $pdo->prepare('SELECT * FROM jobs WHERE idjobs= :idjobs');

$criteria = [
'idjobs' => $_GET['walkID'],
];

$jobs->execute($criteria);

foreach($jobs as $job){
  $output1 = $job['customer'];
  $output2 = $job['service'];
  $output3 = $job['booking'];
  $output4 = $job['staff'];
}

// Listing table info into variables

$customer = $pdo->prepare('SELECT * FROM users WHERE username = :customer');

$criteria2 = [
  'customer' => $output1,
];

$customer->execute($criteria2);

foreach ($customer as $details){
  $userEmail = $details['email'];
  $userName = $details['firstname'];
  $userLocation = $details['postcode'];
}

// grabbing user data


$stmt1 = $pdo->prepare('INSERT INTO completed(customer, service, booking, notes, staff)
SELECT customer, service, booking, notes, staff
FROM jobs
WHERE idjobs = :idjobs');

$criterias = [
'idjobs' => $_GET['walkID'],
];

$stmt1->execute($criterias);

// marking job as completed

$stmt2 = $pdo->prepare('DELETE FROM jobs WHERE idjobs = :idjobs');
$stmt2->execute($criterias);


/*
$checkin = $pdo->prepare('UPDATE jobs SET checked = :checked WHERE idjobs = :idjobs');

$criteria1 = [
'idjobs' => $_GET['walkID'],
'checked' => "Complete",
];

$checkin->execute($criteria1);
*/


// use PHPMailer class to email customer
$mail = new PHPMailer;

 // DEBUGGING -- $mail->SMTPDebug = 2;
  $mail->isSMTP();                            // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                     // Enable SMTP authentication
  $mail->Username = 'adventurescanine@gmail.com';     // SMTP username
  $mail->Password = 'canineadventures1';             // SMTP password
  $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                          // TCP port to connect to

  $mail->setFrom('info@example.com', 'CanineAdventures');
  $mail->addReplyTo('info@example.com', 'CanineAdventures');
  $mail->addAddress('brynweed@gmail.com');   // Add a recipient
  $mail->addCC('cc@example.com');
  $mail->addBCC('bcc@example.com');

  $mail->isHTML(true);  // Set email format to HTML

  $bodyContent = '<h1>Check-in Completed</h1>';
  $bodyContent .= '<p>This is an email to confirm that staff member '. $output4 .' has checked in at '. $userLocation .' to complete the requested service at '. $output3 .'.</p><br>
  The walk has been tracked using GPS technology to ensure that your service has been completed, to view the map click the link: http://v.je/tracked.php';

  $mail->Subject = 'Check in Confirmation';
  $mail->Body    = $bodyContent;

  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    echo 'Message has been sent';
  }

  header("Location: /admin/index.php");
