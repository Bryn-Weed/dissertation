<?php

 include 'adminhead.php';


// updating existing product details for set item

	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE stock
								SET title = :title,
								    description = :description,
								    price = :price,
										wasprice = :wasprice,
										idate = :idate,
								    categoryId = :categoryid
								   WHERE id = :id
						');

		$criteria = [
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'categoryid' => $_POST['categoryid'],
			'id' => $_POST['id'],
			'wasprice' => $_POST['wasprice'],
			'idate' => $_POST['idate']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'Product saved';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

			$currentProduct = $pdo->query('SELECT * FROM stock WHERE id = ' . $_GET['id'])->fetch();


		?>




			<h2>Edit Product</h2>

			<form action="editproduct.php" method="POST" enctype="multipart/form-data">

				<input type="hidden" name="id" value="<?php echo $currentProduct['id']; ?>" />
				<label>Product Name</label>
				<input type="text" name="title" value="<?php echo $currentProduct['title']; ?>" />
<br>
				<label>Description</label>
				<textarea name="description"><?php echo $currentProduct['description']; ?></textarea>
<br>
				<label>Price</label>
				<input type="text" name="price" value="<?php echo $currentProduct['price']; ?>" />
<br>
				<label>WAS Price</label>
				<input type="text" name="wasprice" value="<?php echo $currentProduct['wasprice']; ?>" />
<br>
				<label>Date</label>
				<input type="text" name="idate" value="<?php echo $currentProduct['idate']; ?>" />
<br>
				<label>Category</label>

				<select name="categoryid">
				<?php
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();

					foreach ($stmt as $row) {
						if ($currentProduct['categoryId'] == $row['id']) {
							echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
						else {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}

					}

				?>

				</select>
<br>

				<?php

					if (file_exists('../productimages/' . $currentProduct['id'] . '.jpg')) {
						echo '<img src="../productimages/' . $currentProduct['id'] . '.jpg" />';
					}
				?>
				<label>Product image</label>

				<input type="file" name="image" />

				<input type="submit" name="submit" value="Save Product" />

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
