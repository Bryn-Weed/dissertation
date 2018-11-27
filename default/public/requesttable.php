<h3 class="text-center">Requests</h3>
 <p class="text-center">Accept requests to assign yourself to job.<br> Job can be added to your calendar.</p>
<div class="row text-center">
<?php

$services = $pdo->prepare('SELECT * FROM requests');
$services->execute();
?>

<table class="table" cellspacing="0" width="100%">
 <thead class="thead-dark">
   <tr>
     <th scope="col">#</th>
     <th scope="col">Name</th>
     <th scope="col">Service</th>
     <th scope="col">Date & Time</th>
     <th scope="col">Notes</th>
     <th scope="col">Action</th>
   </tr>
 </thead>
 <tbody>
   <?php
   //list all requests made
 foreach($services as $service){
  echo '<tr>';
  echo '<th scope="row">' . $service['idrequests'] . '</th>';
  echo '<td align="left">' . $service['username'] . '</td>';
  echo '<td align="left">' . $service['service'] . '</td>';
  echo '<td align="left">' . $service['booking'] . '</td>';
  echo '<td align="left">' . $service['notes'] . '</td>';
  echo '<td align="left"><a href="acceptrequest.php?idrequests= ' . $service['idrequests'] . '" style="color:#B15713">Accept </a><span class="glyphicon glyphicon-ok"></span></td>';
  echo '</tr>';
 }
 ?>

 </tbody>
</table>


</div>
