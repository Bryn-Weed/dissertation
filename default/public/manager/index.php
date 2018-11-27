<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../head.php';
  include '../login.php';
  include '../request.php';
  include 'completejobs.php';
  ?>
<link rel="stylesheet" href="../styling.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
<link rel="icon" type="image/png" href="../favicon/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../favicon/favicon-16x16.png" sizes="16x16" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('table.table').DataTable();
} );
</script>


</head>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['rank'] == 3){
?>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#myPage">Canine Adventures - Admin</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myPage">TOP</a></li>
        <li><a href="#services">REQUESTS</a></li>
        <li><a href="#calendar">CALENDAR</a></li>
        <li><a href="../index.php">HOME</a></li>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['rank'] == 3){
          echo '<li><a href="../logout.php">LOG OUT</a></li>';
        }

        ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><p class="glyphicon glyphicon-cog"></p>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="editservice.php">Services</a></li>
            <li><a href="../editprofile.php">Profile</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



<!-- Container  Banner BG  -->
<div style="background: url('/serviceimages/banner.jpg'); width: 1900px; height: auto; background-repeat: no-repeat;" class="bgimg">
  <font color="#eee"><h2>Manager Area</h2>
  <p><em>Canine Adventures.</em></p>
  <p>Company can be managed in this section. </p>
  <br></font>

</div>

<!-- Container Services Section -->
<div id="services" class="bg-1">
  <div class="container">
<h3 class="text-center">Completed Jobs</h3>
 <p class="text-center">A list all completed company jobs.</p>
<div class="row text-center">
<?php
// listing completed jobs
$jobs = $pdo->prepare('SELECT * FROM completed');
$jobs->execute();
?>

<table id="pagination" class="table" cellspacing="0" width="100%">
 <thead class="thead-dark">
   <tr>
     <th scope="col">#</th>
     <th scope="col">Customer</th>
     <th scope="col">Service</th>
     <th scope="col">Date & Time</th>
     <th scope="col">Notes</th>
     <th scope="col">Completed By</th>
   </tr>
 </thead>
 <tbody>
   <?php
 foreach($jobs as $job){
  echo '<tr>';
  echo '<th scope="row">' . $job['idcompleted'] . '</th>';
  echo '<td align="left">' . $job['customer'] . '</td>';
  echo '<td align="left">' . $job['service'] . '</td>';
  echo '<td align="left">' . $job['booking'] . '</td>';
  echo '<td align="left">' . $job['notes'] . '</td>';
  echo '<td align="left">' . $job['staff'] . '</td>';
  echo '</tr>';
 }
 ?>
 </tbody>
</table>

<a href="/manager/index.php" class="btn">Refresh <span class="glyphicon glyphicon-refresh"></span></a>


</div>
</div>
</div>

<!-- Container for Contact -->
<div id="calendar" class="container">
  <h3 class="text-center">Calendar</h3>
  <p class="text-center"><em>Canine Adventures Interactive Calendar.</em></p>
    <p class="text-center"><em>Click on an event to copy it to your own calendar.</em></p>

<!-- Google Calendar Embed -->
<iframe src="https://calendar.google.com/calendar/embed?title=Canine%20Adventures&amp;showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;height=400&amp;wkst=1&amp;hl=en_GB&amp;bgcolor=%23ffffff&amp;src=adventurescanine%40gmail.com&amp;color=%23B1440E&amp;src=en.uk%23holiday%40group.v.calendar.google.com&amp;color=%234E5D6C&amp;ctz=Europe%2FLondon" style="border-width:0" width="1000" height="400" frameborder="0" scrolling="no"></iframe>
  <br>
</div>

<div id="services" class="bg-1">
  <div class="container">
    <h3 class="text-center">Solved Enquiries</h3>
    <p class="text-center">A list of completed customer enquiries.</p>
  <div class="row text-center">
<?php

// listing unsolved enquiries
$enquiries= $pdo->prepare('SELECT * FROM enquiries WHERE dealt_with = 1');
$enquiries->execute();
	?>

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Comments</th>
				<th scope="col">Solved By</th>
	    </tr>
	  </thead>
	  <tbody>
			<?php
		foreach($enquiries as $query){
	   echo '<tr>';
	   echo '<th scope="row">' . $query['idenquiries'] . '</th>';
	   echo '<td align="left">' . $query['name'] . '</td>';
	   echo '<td align="left">' . $query['email'] . '</td>';
	   echo '<td align="left">' . $query['comments'] . '</td>';
     echo '<td align="left">' . $query['dealt_by'] . '</td>';
	   echo '</tr>';
		}
		?>

	  </tbody>
	</table>


 </div>
</div>



<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>
  &copy; Canine Adventures <?php  echo date("Y"); ?></p>
</footer>
<?php
}
else {
	echo '<p> You are not authorised to view this page.</p>';
}
?>
<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})


$('#myModal1').on('show.bs.modal', function(e) {
 var idparameter = e.relatedTarget.dataset.idparameter;
 document.getElementById("servicetext").innerHTML = 'Service:' +idparameter;

});

$(function(){
            $('#datetimepicker11').datetimepicker({
                daysOfWeekDisabled: [0, 6]
            });
        });


</script>

</body>
</html>
