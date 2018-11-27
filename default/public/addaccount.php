
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php';
  ?>
<link rel="stylesheet" href="../styling.css"/>
</head>
<body background="/serviceimages/bgimage.jpg" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php


if ( isset( $_POST['submit'] ) ) {


  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $username = $_POST['username'];
  $password = $hash;
  $firstname = $_POST['firstname'];
  $surname = $_POST['surname'];
  $postcode = $_POST['postcode'];
  $email = $_POST['email'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];

//ensure all fields are populated
  if (empty($username) || empty($password) || empty($firstname) || empty($surname) || empty($postcode) || empty($email) || empty($address1)){
    $error = "Complete all fields.";
  }

//proper email validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = "Enter a valid email.";
  }

//restriction on password size
  if (strlen($password) <= 2){
    $error = "Password must be longer than 2 characters.";
  }

//create account if no errors exist
  if(!isset($error)){
    $sth = $pdo->prepare("SELECT username FROM users WHERE username = :name");
    $sth->bindParam(':name', $username);
    $sth->execute();

    if ($sth->rowCount() > 0){
      Echo "Username already exists.";
    }

    else {

      $stmt = $pdo->prepare('INSERT INTO users(username, password, firstname, surname, postcode, userrank, email, address1, address2)
     VALUES(:username, :password, :firstname, :surname, :postcode, :userrank, :email, :address1, :address2)
     ');
     // if both sections are verified, run the insert with valid information

   $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
   // hash the password with inbuilt function for security
     $criteria = [
       'username' => $username,
       'password' => $password,
       'firstname' => $firstname,
       'surname' => $surname ,
       'postcode' => $postcode,
       'userrank' => 1,
       'email' => $email,
       'address1' => $address1,
       'address2' => $address2,
     ];

     $stmt->execute($criteria);

     echo '<center><font size="18">Account created! Return to the <a href="http://v.je">Home Page</a> to continue.</font></center>';

    }
  }
    else {
      //return user error listing specific error 
      echo "An error has occured: " .$error;
      echo "Please click <a href='/addaccount.php'> here</a> to try again.";
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
  <h4><span class="glyphicon glyphicon-lock"></span> Create an Account</h4>
</div>
<div class="modal-body">
  <form role="form" action=
  "addaccount.php"
   method="POST">
<div class="form-group">
  <div id="left">
   <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username: </label><br>
   <input type="text" name="username" value="<?php echo isset($_POST['username'])?$_POST['username']:''?>"
  	/><br>
  </div>
  </div>
  <div class="form-group">
    <div id="right">
  	<label><span class="glyphicon glyphicon-eye-close"></span> Password: </label><br>
    <input type="password" name="password" value="<?php echo isset($_POST['password'])?$_POST['password']:''?>"
  	/><br>
  </div>
  </div>
  <div class="form-group">
    <div id="left">
    <label>First Name: </label><br>
    <input type="text" name="firstname" value="<?php echo isset($_POST['firstname'])?$_POST['firstname']:''?>"
  	/><br>
  </div>
  </div>
    <div class="form-group">
      <div id="right">
    <label>Surname: </label><br>
    <input type="text" name="surname" value="<?php echo isset($_POST['surname'])?$_POST['surname']:''?>"
    /><br>
  </div>
  </div>
  <div class="form-group">
    <div id="left">
    <label>Post Code: </label><br>
     <input type="text" name="postcode" value="<?php echo isset($_POST['postcode'])?$_POST['postcode']:''?>"
    /><br>
  </div>
  </div>
  <div class="form-group">
    <div id="right">
    <label>Address Line 1: </label><br>
     <input type="text" name="address1" value="<?php echo isset($_POST['address1'])?$_POST['address1']:''?>"
    /><br>
  </div>
  </div>
  <div class="form-group">
      <div id="left">
    <label>Address Line 2: </label><br>
     <input type="text" name="address2" value="<?php echo isset($_POST['address2'])?$_POST['address2']:''?>"
    /><br>
  </div>
</div>
  <div class="form-group">
    <div id="right">
     <label>Email: </label><br>
    <input type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''?>"/><br><br><br>
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
?>
</body>
