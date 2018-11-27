<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'head.php';


require './include/PHPMailer-master/src/Exception.php';
require './include/PHPMailer-master/src/PHPMailer.php';
require './include/PHPMailer-master/src/SMTP.php';
?>

<div id="paymentForm">
<form name="form" method="POST" action="smartpayhpp256.php">


<div class="modal-header">
  <a href="http://v.je"><span class="glyphicon glyphicon-home"></span> Home</a>
  <h4><span class="glyphicon glyphicon-shopping-cart"></span>Checkout</h4>
</div>
<div class="modal-body">
  <p>
        <h2> Payment Amount: £<?php
        $amount = $_POST['paymentAmount'];
        $formatAmount = $amount/100;
        echo $formatAmount;
         ?></h2>
         <input type="hidden" name="merchantReference" value="Test"/></br>
        <input type="hidden" name="paymentAmount" value="<?php echo $_POST['paymentAmount']?>"/>
       <input type="hidden" name="sessionValidity" value="2018-09-30T17:30:00Z"/></br>
        <input type="hidden" name="shopperLocale" value="en_GB"/>
        <input type="hidden" name="shopperEmail" value="<?php echo $_POST['shopperEmail']?>"/>
        Order Reference: <input type="text" name="shopperReference" value="<?php echo $_POST['shopperID']?>" readonly/>
        <input type="hidden" name="currencyCode" value="GBP"/>
       <input type="hidden" name="skinCode" value="wY3add8O"/>
       <input type="hidden" name="hmacKey" value="0C142E9A2876BEA01269E46D430484E1FC2D6653367DD8425E0BD862D44C6BB1"/>
       <input type="hidden" name="merchantAccount" value="BWeedeComm"/>
    </p>
    <p>Clicking the button below will forward you to the Adyen payment gateway, a 3rd party security measure provided by Barclaycard.
      <br>Canine Adventures' failure to meet the services requested will result in a full refund.<br>
      A confirmation email will be sent to the address associated with your user account containing payment details.</p>
    <input type="submit" class="btn" value="Click to Pay">
</form>
</div>

<?php

$jobs = $pdo->prepare('SELECT * FROM cart WHERE username = :username');

$criteria = [
'username' => $_SESSION['username'],
];

$jobs->execute($criteria);

foreach($jobs as $job){
  $output1 = $job['username'];
  $output2 = $job['service'];
  $output3 = $job['booking'];
  $output4 = $job['notes'];
  $output5 = $job['status'];
  $output6 = $job['employee'];

  $newjob = $pdo->prepare('INSERT INTO jobs(customer, service, booking, notes, status, staff)
  VALUES(:customer, :service, :booking, :notes, :status, :staff)
  ');

  $criteria1 = [
  'customer' => $output1,
  'service' => $output2,
  'booking' => $output3,
  'notes' => $output4,
  'status' => 'Paid',
  'staff' => $output6,
  ];

  $newjob->execute($criteria1);
}




$deleterequest = $pdo->prepare('DELETE FROM cart WHERE username = :username');

$criteria2 = [
  'username' => $_SESSION['username'],
];

$deleterequest->execute($criteria2);


// DEBUGGING -- echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
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

  $bodyContent = '<h1>Payment Confirmation</h1>';
  $bodyContent .= '<p>This is an email to confirm that your payment has been processed, and your request will be completed on the scheduled date.</p>';

  $mail->Subject = 'Payment Confirmation';
  $mail->Body    = $bodyContent;

  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    echo 'Message has been sent';
  }
