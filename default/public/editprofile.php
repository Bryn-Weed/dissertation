<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php';
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  ?>
<link rel="stylesheet" href="../styling.css"/>
</head>
<body background="/serviceimages/bgimage3.jpg" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :name");

  $criteria  = [
'name' => $_SESSION['username'],
  ];

  $stmt->execute($criteria);
// grabbing existing user data
  foreach ($stmt as $data) {
    $usernameField = $data['username'];
    $firstnameField = $data['firstname'];
    $surnameField = $data['surname'];
    $postcodeField = $data['postcode'];
    $emailField = $data['email'];
    $address1Field = $data['address1'];
    $address2Field = $data['address2'];
  }


if ( isset($_POST['submit'])) {
// updating new user data
  $username = $_SESSION['username'];
  $firstname = $_POST['firstname'];
  $surname = $_POST['surname'];
  $postcode = $_POST['postcode'];
  $email = $_POST['email'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];

  if (empty($firstname) || empty($surname) || empty($postcode) || empty($email)){
    $error = "Complete all fields.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = "Enter a valid email.";
  }

    if (!isset($error)){

      $stmt = $pdo->prepare('UPDATE users SET firstname = :firstname, surname = :surname, postcode = :postcode,  email = :email, address1 = :address1, address2 = :address2 WHERE username = :username');



     $criteria = [
       'firstname' => $_POST['username'],
       'surname' => $_POST['surname'],
       'postcode' => $postcode,
       'email' => $email,
       'username' => $_SESSION['username'],
       'address1' => $address1,
       'address2' => $address2,
     ];

     $stmt->execute($criteria);

     echo '<center><font size="18">Account edited! Return to the <a href="http://v.je">Home Page</a> to continue.</font></center>';

    }

    else {
      echo "An error has occured: " .$error;
      exit();
    }

}


else {
	// create account form

?>
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <a href="http://v.je"><span class="glyphicon glyphicon-home"></span> Home</a>
  <h4><span class="glyphicon glyphicon-lock"></span>Edit Account</h4>
</div>
<div class="modal-body">
  <form action=
  "editprofile.php"
   method="POST">
   <div class="form-group">
     <div id="left">
      <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username: </label><br>
      <input type="text" name="username" value="<?php echo $usernameField ?>"
     	/><br>
     </div>
     </div>
     <div class="form-group">
       <div id="right">
       <label>First Name: </label><br>
       <input type="text" name="firstname" value="<?php echo $firstnameField ?>"
     	/><br>
     </div>
     </div>
       <div class="form-group">
         <div id="left">
       <label>Surname: </label><br>
       <input type="text" name="surname" value="<?php echo $surnameField ?>"
       /><br>
     </div>
     </div>
     <div class="form-group">
       <div id="right">
       <label>Post Code: </label><br>
        <input type="text" name="postcode" value="<?php echo $postcodeField?>"
       /><br>
     </div>
     </div>
     <div class="form-group">
       <div id="left">
       <label>Address Line 1: </label><br>
        <input type="text" name="address1" value="<?php echo $address1Field ?>"
       /><br>
     </div>
     </div>
     <div class="form-group">
         <div id="right">
       <label>Address Line 2: </label><br>
        <input type="text" name="address2" value="<?php echo $address2Field ?>"
       /><br>
     </div>
   </div>
     <div class="form-group">
       <div id="left">
        <label>Email: </label><br>
       <input type="text" name="email" value="<?php echo $emailField?>"/><br><br><br>
      </div>
    </div>


     <div class="form-group">
     <button type="submit" value="Submit" name="submit" class="btn btn-block">Submit
     <span class="glyphicon glyphicon-ok"></span>
   </button>
   Data will not be shared beyond the company, and will only be used to provide the proper service to customers as requested.
   </div>


     </form>
   </div>
   </div>
   </div>

  <?php

}

}
else {
echo '<p> You are not authorised to view this page. </p>';
}

?>
</body>
