<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php';
  include 'login.php';
  include 'request.php';
  include 'query.php';
  ?>


  <!-- Theme Made By www.w3schools.com - No Copyright -->
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

<a class="navbar-brand" href="#myPage">© Canine Adventures </a>
      <a class="navbar-brand" href="#myPage"><img src="/serviceimages/logo1.png" style="'float: left;'"/></a>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#about">ABOUT US</a></li>
        <li><a href="#service">SERVICES</a></li>
        <li><a href="#contact">HELP</a></li>
        <li class="divider-vertical"></li>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

          $cartcount = $pdo->prepare('SELECT count(*) as total_rows FROM cart WHERE username = :username');


          $criteria3 = [
            'username' => $_SESSION['username'],
          ];
            $cartcount->execute($criteria3);
            $count = $cartcount->fetch(PDO::FETCH_ASSOC);
            $total_rows = $count['total_rows'];
// bespoke navigation bar for each user tier
          echo '<li><a title="You have items in your cart!" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>(' . $total_rows . ')</a>';
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['rank'] == 2){
          echo '<li><a href="logout.php">LOG OUT</a></li>';
          echo '<li><a href="/admin/index.php">STAFF</a></li>';
        }
        else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['rank'] == 3){
          echo '<li><a href="logout.php">LOG OUT</a></li>';
          echo '<li><a href="/admin/index.php">STAFF</a></li>';
          echo '<li><a href="/manager/index.php">ADMIN</a></li>';
        }
        else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['rank'] == 1){
          echo '<li><a href="logout.php">LOG OUT</a></li>';

        }
        else  {
          echo '<li><a href="#myModal" data-toggle="modal" data-target="#myModal">LOG IN</a></li>';
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
          echo '<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><p class="glyphicon glyphicon-cog"></p>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="faq.php"><span class="glyphicon glyphicon-pushpin"></span> FAQ</a></li>
              <li><a href="editprofile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            </ul>
          </li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="./serviceimages/landing1.jpg" alt="Dog" width="1280" height="720">
        <div class="carousel-caption">
          <h3>"Very good service all round. Definitely recommend!"</h3>
          <p>- Pete Jensen</p>
          <div class="scrollarrow">
          <a id="go" class="down-arrow" href="#about" data-toggle="tooltip">
            <span class="glyphicon glyphicon-chevron-down"></span>
          </a>
        </div>
      </div>
    </div>

      <div class="item">
        <img src="./serviceimages/landing2.jpg" alt="Dog" width="1280" height="720">
        <div class="carousel-caption" style="top: 120px; ">
          <h3>"Took care of my dog and walked it really well."</h3>
          <p>- Angela Roberts</p>
          <a class="down-arrow" href="#about" data-toggle="tooltip">
            <span class="glyphicon glyphicon-chevron-down"></span>
          </a>
        </div>
      </div>

      <div class="item">
        <img src="./serviceimages/landing3.jpg" alt="Dog" width="1280" height="720">
        <div class="carousel-caption">
          <h3>"Taught me how to control my dog and keep it happy at the same time!"</h3>
          <p>- Wendy Samson</p>
          <a class="down-arrow" href="#about" data-toggle="tooltip">
            <span class="glyphicon glyphicon-chevron-down"></span>
          </a>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The about Section) -->
<div id="about" class="container text-center">
  <h3>About Us</h3>
  <p><em>Canine Adventures.</em></p>
  <p>Canine Adventures is a dog walking, training, and care business located in Northampton. </p>
  <p>The company caters to customers within Northamptonshire.</p>
  <p>Our employees are very well trained and kind!</p>
  <br>
  <div class="row">

    <div class="col-sm-4">
      <p class="text-center"><strong>Martin Worker</strong></p><br>
        <img src="./serviceimages/Martin.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
      <a href="#demo3" data-toggle="collapse">
      <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
      <div id="demo3" class="collapse">
        <p>Dog Trainer</p>
        <p>Fully Certified</p>
        <p>Employee at Canine Adventures</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Nicola Hawthorn</strong></p><br>
        <img src="./serviceimages/Nicola.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
      <a href="#demo2" data-toggle="collapse">
      <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
      <div id="demo2" class="collapse">
        <p>Dog Care Specialist</p>
        <p>Loves walking dogs</p>
        <p>Manager of Canine Adventures</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Caroline Guest</strong></p><br>
        <img src="./serviceimages/Caroline.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
      <a href="#demo4" data-toggle="collapse">
      <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
      <div id="demo4" class="collapse">
        <p>Dog Sitter</p>
        <p>Professional Dog Carer</p>
        <p>Employee at Canine Adventures</p>
      </div>
    </div>
    <div class="scroller"><p>Scroll<br><a  href="#service" style="color:#333; font-size: 20px;" data-toggle="tooltip">
      <span class="glyphicon glyphicon-chevron-down"></span>
    </a></p></div>
  </div>

</div>

<!-- Container (service Section) -->
<div id="service" class="bg-1">
  <div class="container">
    <h3 class="text-center">Our Services</h3>
    <p class="text-center">Dog care specialists.<br> Book online or in person.</p>
  <div class="row text-center">
<?php

$services = $pdo->prepare('SELECT * FROM stock');
$services->execute();
foreach($services as $service){

// list all services with individual info
      echo '<div class="col-sm-4">';
        echo '<div class="thumbnail">';
        if (is_file('./serviceimages/' . $service['id'] . '.jpg')){
          echo '<img src="serviceimages/' . $service['id'] . '.jpg" alt="' . $service['title'] . '" width="400" height="300">';
        }
        echo '<p><strong>' .  $service['title'] . '</strong></p>';
        echo '<p>£' . $service['price'] . ' per ' .  $service['per'] . '.</p>';
        echo '<a data-toggle="collapse" class="btn1" data-target="#data'. $service['id'] .'">  <span class="glyphicon glyphicon-chevron-down"></span></a>';
        echo '<div id="data'. $service['id']. '" class="collapse">';
        echo '<p>-----</p>';
        echo '<p class="ex1">' . $service['description'] .'</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        }

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<a href="#myModal1" class="btn1" data-toggle="modal" data-target="#myModal1" data-idparameter="' . $service['id'] . '">Request</a>';
        }
    else  {
      echo '<button class="btn1" data-toggle="modal" data-target="#myModal">Request</button>';
        }
?>

</div><br><Br>
 <div class="scroller"><p class="text-center">Scroll<br><a  href="#contact" style="color:#ccc; font-size: 20px;" data-toggle="tooltip">
   <span class="glyphicon glyphicon-chevron-down"></span>
 </a></p></div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><img src="/serviceimages/logo2.png" height="100px" width="auto" ></span> Log In</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="loginform" method="post">
            <div class="form-group">
              <?php if(isset($error_msg)){echo $error_msg; } ?>
              <label for="psw"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" name="username" class="form-control" id="usrname" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-eye-close"></span> Password</label>
              <input type="password" name="password" class="form-control" id="psw" placeholder="Password">
            </div>
              <button type="submit" name="submit" value="submit" class="btn btn-block">Submit
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Create an <a href="addaccount.php">account.</a></p>
        </div>
      </div>
    </div>
  </div>

<!-- run scripts for error messages obtained from service or login -->
  <?php if(isset($script)){ echo $script; } ?>
    <?php if(isset($script2)){ echo $script2; } ?>
    <?php if(isset($script3)){ echo $script3; } ?>


  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><img src="/serviceimages/logo2.png" height="100px" width="auto" >Services</h4>
          <h5>Please complete all fields marked with an asterisk ( <span style="font-size: 24px !important; color: #b15713">*</span> ).</h5>
        </div>
        <div class="modal-body">
          <form role="form" id="bookingform" method="post">
            <div class="form-group">
              <!-- print error message -->
              <?php if(isset($error_msg1)){echo $error_msg1; } ?>
              <label for="booking"><span style="font-size: 24px !important; color: #b15713">*</span><span class="glyphicon glyphicon-book"></span> Booking:</label><br>
              <p>Weekends are not available for booking.</p>
              <div class='input-group date' id='datetimepicker11'>
                 <input type='text' class="form-control" name="date" readonly/>
                 <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar">
                     </span>
                 </span>
             </div>
             <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" name="time" readonly/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-tag"></span> Additional Information:</label>
              <p>Does your dog have any special dietary requirements?</p>
              <input type="text" name="requirements" class="form-control" id="notes" placeholder="e.g. 'Dog food only!'"><br>
              <p>Does your dog behave well with others?</p>
              <input type="text" name="behaviour" class="form-control" id="notes1" placeholder="e.g. 'Walks well in groups!'"><br>
              <p>Any extra information: </p>
              <input type="text" name="information" class="form-control" id="notes2" placeholder=" e.g. 'Do not let the dog up on chairs!'"><br>
            </div>
            <div class="form-group">
              <label for="sel1"><bold><span style="font-size: 24px !important; color: #b15713">*</span></bold><span class="glyphicon glyphicon-leaf"></span> Service:</label>
                <select class="form-control" name="service" id="sel1">
                    <option value='Walk(1hr)'>Walk(1hr) - £10.00</option>
                    <option value='Walk(30m)'>Walk(30min) - £8.00</option>
                    <option value='Sitting'>Sitting(day) - £20.00</option>
                    <option value='Training'>Training(1hr) - £10.00</option>
                </select>
           </div>
           <div class="form-group">
             <label for="sel2"><span class="glyphicon glyphicon-user"></span> Preferred Employee:</label>
               <select class="form-control" name="employee" id="sel2">
                   <option value='Manager'>Nicola Hawthorn</option>
                   <option value='Caroline'>Caroline Guest</option>
                   <option value='Martin'>Martin Worker</option>
               </select>
          </div>
           <div class="form-group">
             <center><button type="submit" name="payment" value="payment" class="btn">
               <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
             </button></center>
             <input type="hidden" readonly="readonly" name="payment" class="form-control" id="payment" value="Unpaid">

           </div>


        </div>


        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

      <!-- Modal container -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><img src="/serviceimages/logo2.png" height="100px" width="auto" >Success!</h4>
          <h5>Your request has been added to your shopping cart. <span class="glyphicon glyphicon-shopping-cart"></span>(1) <img src="/serviceimages/arrow.png" height="40px" width="auto"></h5>
        </div>

  </div>
</div>
</div>

<div class="modal fade" id="myModal3" role="dialog">
  <div class="modal-dialog">

    <!-- Modal container-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4><img src="/serviceimages/logo2.png" height="100px" width="auto" >Success!</h4>
        <h5>Login successful. You can now add services to your cart for purchase.<img src="/serviceimages/arrow.png" height="40px" width="auto"></h5>
      </div>

</div>
</div>
</div>



  </div>
<?php if(isset($script1)){ echo $script1; } ?>
<!-- Container for Contact -->
<div id="contact" class="container">

<h3 class="text-center">Frequently Asked Questions</h3>
<button class="accordion">Can I pay in person?</button>
<div class="panel">
  <p>You absolutely can. When requesting a service, you can ignore the payment section if you would prefer to pay the staff when they arrive.</p>
</div>

<button class="accordion">Do I have to order online?</button>
<div class="panel">
  <p>You can also order services over the phone or via email, the contact details are shown in the section below.</p>
</div>

<button class="accordion">My dog doesn't walk well with others, can it be walked separately?</button>
<div class="panel">
  <p>Absolutely. There is a 'Notes' section when requesting a service, where you can let us known of any specific details regarding your request.</p>
</div>

<center>Any more questions? Visit the <a href="faq.php">Help Page</a> for more information.<br>
The Help Page contains more FAQs as well as a chat forum for instant responses.</center>
<script>
var acc = document.getElementsByClassName("accordion");
var i;
// accordion javascript
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
</script>
<br><br>
  <h3 class="text-center">Contact</h3>
  <p class="text-center"><em>We would be happy to help.</em></p>

  <div class="row">
    <div class="col-md-4">
      <p>Any Queries: </p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Irthlingborough, UK</p>
      <p><span class="glyphicon glyphicon-phone"></span> Phone: N/A </p>
      <p><span class="glyphicon glyphicon-envelope"></span> Email: nikkihawthorn@live.co.uk</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <form role="form" id="queryform" method="post">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="queryname" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="queryemail" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="querycomments" placeholder="Comment" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button type="button" class="btn pull-right" data-toggle="snackbar" data-content="Thank you. We'll be in touch!" data-timeout="0" type="submit" name="query">Send</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <br>

</div>


    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

<p class="text-center">Where to find us:</p>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 52.317449, lng: -0.618732};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <!-- Google maps embed with API key -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmQDK-eCR7Rf76LVqwRfdJeJ1B_ZHwk3w&callback=initMap">
    </script>







<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>
  &copy; Canine Adventures <?php  echo date("Y"); ?></p>
</footer>

<script>


$(document).ready(function(){
  // tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // smooth scrolling
  $(".navbar a, #myCarousel a, .scroller a, footer a[href='#myPage']").on('click', function(event) {

    //ensure hash has value
    if (this.hash !== "") {

      // Prevent default click behaviorism
      event.preventDefault();

      // Store hash
      var hash = this.hash;

    // JQuery page scrolling
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // add the # to the url when done scrolling for DIV
        window.location.hash = hash;
      });
    }
  });
})



// datetimepickers from bootstrap
$(function(){
            $('#datetimepicker11').datetimepicker({
                daysOfWeekDisabled: [0, 6],
                format: 'YYYY-MM-DD',
                ignoreReadonly: true
            });
        });

$(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'HH:mm:ss',
                ignoreReadonly: true
            });
        });

//$('body').bootstrapMaterialDesign();

</script>

</body>
</html>
