<?php
require('../adminautoload.php');

// Check if form was sent
if (isset($_POST['createproduct']) && ($_POST['createproduct'] == 'Create Product')) {
	$name = mysql_real_escape_string($_POST['name']);
	$type = mysql_real_escape_string($_POST['type']);
	$weight = mysql_real_escape_string($_POST['weight']);
	$price = mysql_real_escape_string($_POST['price']);
	$active = mysql_real_escape_string($_POST['active']);

	// Some small validation+
	$errors = 0;
	foreach ($_POST as $key => $value) {
		if ($value == '') {
			$_SESSION['flash'][] = $key . ' is empty.';
			$errors++;
		}
	}
	if ($errors == 0) {
		$sql = "INSERT INTO products VALUES ('', '$name', '$type', '$weight', '$price', '$active')";
		print $sql;
		$result = mysql_query($sql);
		if (mysql_affected_rows() > 0) {
			$_SESSION['flash'] = 'Product Added';
			header('location:index.php');
		} else {
			$_SESSION['flash'] = 'Product not added for some reason.';
		}
	} else {
		header('location:' . $_SERVER['PHP_SELF']);
		exit;
	}

}
?>
<html>
	<head>
		<title>Create New Product - LocalGreenery</title>
	</head>
	<body>
		<h1>Create new product</h1>
		<strong>WARNING: THIS FORM IS NOT VALIDATED. ANYTHING YOU INPUT WILL BE SENT!</strong>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset>
				<table>
					<?php if (isset($_SESSION['flash'])
		&& is_array($_SESSION['flash'])) : ?>
					<ul>
						<?php foreach ($_SESSION['flash'] as $error) : ?>
						<li><?php echo $error; ?></li>
						<?php endforeach; ?>
						<?php unset($_SESSION['flash']); ?>
					</ul>
					<?php elseif (isset($_SESSION['flash'])) : ?>
					<tr>
						<td colspan="2"><?php echo $_SESSION['flash'];
	unset($_SESSION['flash']); ?></td>
					</tr>
					<?php endif; ?>
					<tr>
						<td><label for="name">Name: </label></td>
						<td><input type="text" name="name" /></td>
					</tr>
					<tr>
						<td><label for="type">Type: </label></td>
						<td><input type="text" name="type" /></td>
					</tr>
					<tr>
						<td><label for="weight">Weight: </label></td>
						<td><input type="text" name="weight" /></td>
					</tr>
					<tr>
						<td><label for="price">Price: </label></td>
						<td><input type="text" name="price" /></td>
					</tr>
					<tr>
						<td><label for="active">Active: </label></td>
						<td>
							<input type="radio" name="active" value="Y" checked="checked" /> Y<br />
							<input type="radio" name="active" value="N" /> N
						</td>
					</tr>
				</table>
			</fieldset>
			<input type="submit" name="createproduct" value="Create Product" />
		</form>
	</body>
</html>