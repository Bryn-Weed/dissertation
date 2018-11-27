<?php

/*
  skincode - the skin to be used
  merchantACcount - the merchant account we want to process this payment

  sharedSecret is the shared HMAC key
*/

$skinCode = $_POST['skinCode'];
$merchantAccount = $_POST['merchantAccount'];
$hmacKey = $_POST['hmacKey'];
$merchatReference = $_POST['merchantReference'];
$merchantaccount = $_POST['merchantAccount'];
$currencyCode = $_POST['currencyCode'];
$paymentAmount = $_POST['paymentAmount'];
$sessionValidity = $_POST['sessionValidity'];
//$shipBeforeDate = $_POST['shipBeforeDate'];
$shopperLocale = $_POST['shopperLocale'];
$shopperEmail = $_POST['shopperEmail'];
$shopperReference = $_POST['shopperReference'];

$params = array(
  "merchantReference" => $merchatReference,
  "merchantAccount" => $merchantAccount,
  "currencyCode" => $currencyCode,
  "paymentAmount" => $paymentAmount,
  "sessionValidity" => $sessionValidity,
  //"shipBeforeDate" => $shipBeforeDate,
  "shopperLocale" => $shopperLocale,
  "skinCode" => $skinCode,
  "shopperEmail" => $shopperEmail,
  "shopperReference" => $shopperReference
);

$escapeval = function($val) {
  return str_replace(':','\\:',str_replace('\\','\\\\',$val));
};

ksort($params, SORT_STRING);

$signData = implode(":", array_map($escapeval, array_merge(array_keys($params),array_values($params))));

$merchantSig = base64_encode(hash_hmac('sha256', $signData, pack("H*", $hmacKey),true));

$params['merchantSig'] = $merchantSig;

 ?>

 <!-- Complete Submission Form -->

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1-strict.dtd">
 <HTML xmlns="htpps://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
     <title>Adyen Payment</title>
     <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
     <link rel="stylesheet" href="styling.css"/>
   </head>
   <body>
     <form name= "adyenForm" action="https://test.adyen.com/hpp/pay.shtml" method="post">
     <!--<form name="aydenForm" action="https://test.adyen.com/hpp/tokenonepage.shtml" method="post">-->
       <?php
          foreach ($params as $key => $value){
            echo '<div id="paymentForm"><input type="hidden" name="'.htmlspecialchars($key, ENT_COMPAT, 'UTF-8').'" value="'.htmlspecialchars($value, ENT_COMPAT, 'UTF-8').'"/></form>'."\n";
          }
        ?>
        <div class="processing">
        <img src="./serviceimages/loading.gif" alt="Loading animation" height="200px" width="200px">

        </div>
      </form>


      <script>

      function pageLoad()
      {
          submitPayment();
      }

      function submitPayment()
      {
          if(document.contains(document.querySelector('#paymentForm')))
          {
              document.forms['adyenForm'].submit();
          }
          else
          {
              console.warn('NO PAYMENT FORM ON THIS PAGE!');
          }
      }

      function addCart(form)
      {
          if (document.contains(document.querySelector('.basketForm')))
          {
              document.forms['basketForm'][form].submit();
          }
      }

      document.addEventListener('DOMContentLoaded',pageLoad);

      </script>
    </body>
    </html>
