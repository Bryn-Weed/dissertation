<?php
include 'adminhead.php';




		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		?>


			<h2>Solved Enquiries</h2>


			<a class="new" href="enquiries.php">View unsolved enquiries</a>

			<table>
			<thead>
			<tr>
			<th>Details</th>
			<th style="width: 10%">Resolved By</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			</tr>
<?php
			$enquiries = $pdo->query('SELECT * FROM enquiries WHERE dealt_with = 1');
			// list the solved enquiries only 

			foreach ($enquiries as $enquiry) {
				?>
				<tr>
				<td> Name: <?php echo $enquiry['name'];?><br>
				 Contact: <?php echo  $enquiry['email'];?><br>
				 Mobile:  <?php echo  $enquiry['mobile'];?>
<br>
				Enquiry: <?php echo  $enquiry['enquiry'];?></td>

				<td> <?php echo $enquiry['dealt_by'];?></td>
				<!-- Display user name of staff member that resolved enquiry -->

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
