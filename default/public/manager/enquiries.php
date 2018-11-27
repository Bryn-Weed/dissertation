<?php
include 'adminhead.php';




		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		?>


			<h2>Current Enquiries</h2>


			<a class="new" href="solvedenquiry.php">View solved enquiries</a>

			<table>
			<thead>
			<tr>
			<th>Details</th>
			<th style="width: 10%">Act</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			</tr>
<?php
// grabbing all unsolved enquiries 
			$enquiries = $pdo->query('SELECT * FROM enquiries WHERE dealt_with = 0');
			// only list enquiries that haven't been resolved

			foreach ($enquiries as $enquiry) {
				?>
				<tr>
				<td> Name: <?php echo $enquiry['name'];?><br>
				 Contact: <?php echo  $enquiry['email'];?><br>
				 Mobile:  <?php echo  $enquiry['mobile'];?>
<br>
				Enquiry: <?php echo  $enquiry['enquiry'];?></td>

				<td><a style="float: right" href="solved.php?id=<?php echo $enquiry['idenquiries'];?>">Resolved</a></td>
				<!-- link to solved page -->

			</form></td>
				</tr>
				<?php
			}
?>
			</thead>
			</table>
<?php
		}

		else {
			?>
			<h2>Log in</h2>

			<form action="index.php" method="post">
				<label>Username</label>
				<input type="text" name="username" />

				<label>Password</label>
				<input type="password" name="password" />

				<input type="submit" name="submit" value="Log In" />
			</form>
		<?php
		}
	?>

</section>
	</main>
	<?php

	include '../footer.php';

	?>

</body>
</html>
