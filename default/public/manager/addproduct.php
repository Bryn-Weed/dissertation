<?php
include 'adminhead.php';


	if (isset($_POST['submit'])) {
		// prepared statement to avoid SQL injection 

		$stmt = $pdo->prepare('INSERT INTO stock (title, description, price, categoryId, idate, addedby, soldproduct)
							   VALUES (:title, :description, :price, :categoryid, :idate, :addedby, 0)');

		$criteria = [
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'categoryid' => $_POST['categoryid'],
			'addedby' => $_SESSION['username'],
			'idate' => $_POST['idate']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}
// three different file uploads all to upload images to same folder, 'a' and 'b' extensions used so the ID can still
// be used to obtain the images when listing them
		if ($_FILES['image1']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . 'a.jpg';
			move_uploaded_file($_FILES['image1']['tmp_name'], '../productimages/' . $fileName);
		}

		if ($_FILES['image2']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . 'b.jpg';
			move_uploaded_file($_FILES['image2']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'Product added';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		?>


			<h2>Add Product</h2>

			<form action="addproduct.php" method="POST" enctype="multipart/form-data">
				<label>Product Name</label>
				<input type="text" name="title" />

				<label>Description</label>
				<textarea name="description"></textarea>

				<label>Price</label>
				<input type="text" name="price" />

				<label>Date</label>
				<input type="text" name="idate" />

				<label>Category</label>

				<select name="categoryid">
				<?php
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();

					foreach ($stmt as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}

				?>

				</select>

				<label>Product image</label>

				<input type="file" name="image" />

				<input type="file" name="image1" />

				<input type="file" name="image2" />

				<input type="submit" name="submit" value="Add Product" />

			</form>



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

	}
	?>

</section>
	</main>
	<?php
include '../footer.php';


	?>

</body>
</html>
