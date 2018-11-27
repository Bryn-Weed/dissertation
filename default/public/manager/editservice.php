<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../head.php';
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['rank'] == 3){
  ?>
<link rel="stylesheet" href="../styling.css"/>
</head>
<body background="../serviceimages/bgimage.jpg" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="modal-header">
    <a href="http://v.je"><span class="glyphicon glyphicon-home"></span> Home</a>
    <h4><span class="glyphicon glyphicon-lock"></span> Edit Services</h4>
  </div>
<?php

// editing set service

if ( isset($_POST['submit'])) {

  $stmt = $pdo->prepare('UPDATE stock SET title = :title, description = :description, price = :price, per = :per WHERE id = :id');

  $criteria = [
    'id' => $_POST['id'],
    'title' => $_POST['title'],
    'description' => $_POST['desc'],
    'per' => $_POST['per'],
    'price' => $_POST['price'],
     ];

  $stmt->execute($criteria);

     echo '<center><font size="18">Service edited! Return to the <a href="http://v.je/manager/editservice.php">Services Page</a> to continue.</font></center>';

    }

else {
	// create account form



  $stmt1 = $pdo->prepare("SELECT * FROM stock");



  $stmt1->execute();

  foreach ($stmt1 as $data) {
  echo '<div class="row">
        <div class="col-sm-4" style="background-color: #333; color: #ccc;">
        <h4><a href="#demo' . $data['id'] . '" data-toggle="collapse">
        <span class="glyphicon glyphicon-cog"></span></a>
        <strong><u>' . $data['title'] . '</strong></a></u></h4>';
  echo '<div id="demo' . $data['id'] . '" class="collapse">';
  echo '<form role="form" action=
        "editservice.php"
        method="POST" id="serviceform">';
  echo '<div class="form-group"><label>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </label>';
  echo '&nbsp;&nbsp;&nbsp;<input type="text" name="title" value="' . $data['title'] . '"/><br></div>';
  echo '<div class="form-group"><label>Price:   </label>';
  echo '&nbsp;&nbsp;&nbsp;<input type="text" name="price" value="' . $data['price'] . '"/><br></div>';
  echo '<div class="form-group"><label>Per: </label>';
  echo '&nbsp;&nbsp;&nbsp;<input type="text" name="per" value="' . $data['per'] . '"/><br></div>';
  echo '<div class="form-group"><label>Description: </label>';
  echo '&nbsp;&nbsp;&nbsp;<input type="text" name="desc" value="' . $data['description'] . '"/></div>';
  echo '<br><div class="form-group"><button type="submit" value="Submit" name="submit" class="btn" style="background-color: #fff; color: #333;">Submit
        <span class="glyphicon glyphicon-ok"></span>
        </button></div>';
  echo '<input type="hidden" name="id" value=" ' . $data['id'] . '"/>';
  echo '</form></div>
        </div></div>';
  }


}

}
else {
echo '<p> You are not authorised to view this page. </p>';
}

?>
</body>
