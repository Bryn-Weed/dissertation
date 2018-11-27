<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>FAQ</title>

    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="styling.css" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">

        // get username of new guest with prompt, default to Guest
        var username = prompt("Enter your username:", "Guest");


    	if (!username || username === ' ') {
    	   username = "Guest";
    	}

    	// strip all the tags from usernames
    	username = username.replace(/(<([^>]+)>)/ig,"");

    	// display the guests name
    	$("#username-area").html("You are: <span>" + username + "</span>");

    	// start an instance of the chat
        var chat =  new Chat();

    	$(function() {



        chat.getState();





    		 // constantly wait for key press
             $("#send").keydown(function(event) {

                 var key = event.which;


                 if (key >= 33) {

                     var maxLength = $(this).attr("maxlength");
                     var length = this.value.length;

                     // if the string length is max, do not allow more text
                     if (length >= maxLength) {
                         event.preventDefault();
                     }
                  }
    		 																																																});
    		 // constantly watch for no more key press
    		 $('#send').keyup(function(e) {

    			  if (e.keyCode == 13) {

                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");
                    var length = text.length;

                    // send the message
                    if (length <= maxLength + 1) {

    			        chat.send(text, username);
    			        $(this).val("");

                    } else {

    					$(this).val(text.substring(0, maxLength));

    				}


    			  }
             });

    	});
    </script>
<?php
/*if (file_exists('chat.txt')){
  $lines = file('chat.txt');
  $text= array();
  foreach ($lines as $line) {
    $text[] = $line = str_replace("n", "", $line);
  }
}*/
?>
</head>

<body onload="setInterval('chat.update()', 1000)">

<div id="page-wrap">
<h2>Frequently Asked Questions</h2>

  <div class="row">
<div class="col-md-4">

        <button class="accordion">Can I pay in person?</button>
        <div class="panel">
          <p>You absolutely can. When requesting a service, you can ignore the payment section if you would prefer to pay the staff when they arrive.</p><br>
        </div><br>

        <button class="accordion">Do I have to order online?</button>
        <div class="panel">
          <p>You can also order services over the phone or via email, the contact details are shown in the section below.</p><br>
        </div><br>

        <button class="accordion">My dog doesn't walk well with others, can it be walked separately?</button>
        <div class="panel">
          <p>Absolutely. There is a 'Notes' section when requesting a service, where you can let us known of any specific details regarding your request.</p><br>
        </div><br>

        <button class="accordion">My dog has a very specific diet, how will this be handled?</button>
        <div class="panel">
          <p>Let us know in the "Notes" section when adding a service to your cart. From there we can negotiate how it will be handled; you can either provide the food yourself or we can find it as well.</p><br>
        </div><br>

        <button class="accordion">I don't own a lead or any toys for my dog, what can I do?</button>
        <div class="panel">
          <p>Canine Adventures can provide leads and toys for dog walking and training.</p><br>
        </div><br>
        <h5><font color="#eee"> If your question has not been answered, try asking in the chat forum below:</font> </h5>
</div>



<br><br><Br>
        <h2>FAQ Chat Forum</h2>

      <div class="col-md-8">

        <div id="chat-wrap"><div id="chat-area"></div>

        <form id="send-message-area">
          <!-- <p id="username-area"></p> -->
            <center><p>Your message: </p></center>
            <textarea id="send" maxlength = '100' ></textarea>
        </form>
      </div>

</div>
</div>
</div>

<a class="btn" href="http://v.je"> < Home </a>




    <script>

// loading the chat
$(document).ready(chat.loadChat);
// Accordion JavaScript 
    var acc = document.getElementsByClassName("accordion");
    var i;

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
</body>

</html>
