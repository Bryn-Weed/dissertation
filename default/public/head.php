<?php

session_start();
$pdo = new PDO('mysql:dbname=antiques;host=127.0.0.1', 'student', 'student');
// Database connection
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Canine Adventures <?php if (isset($title)) { echo $title; } else if (isset($pagetitle)) { echo $pagetitle;} else {}?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type ="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
		<script src="https://cdn.rawgit.com/HubSpot/tether/v1.3.4/dist/js/tether.min.js"></script>
		<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
		<!-- <script src="https://cdn.rawgit.com/FezVrasta/bootstrap-material-design/dist/dist/bootstrap-material-design.iife.min.js"></script> -->
		<link rel="stylesheet" href="styling.css"/>
		<link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16" />
	</head>
