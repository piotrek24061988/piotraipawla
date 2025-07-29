<?php
	@session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">

	<head>
	<?php include 'template/header.php'; ?>
</head>

<body>

	<?php include 'template/menu.php'; ?>

	<main class="container">
		<?php include 'template/scrollup.php'; ?>
		
		<div class="bg-light mt-1 content text-center">

			<h3>Newsletter:</h3>
			<h5>Zapisz się a ogłoszenia parafialne będziesz otrzymywać mailowo.</h5>
			<form method="post" action="zapisz.php">
				<b>E-mail:</b></br> <input type="text" name="email"/> </br>
				<?php
					if(isset($_SESSION['e_email']))
					{
						echo '<div class="text-danger"><b>'.$_SESSION['e_email'].'</b></div>';
						unset($_SESSION['e_email']);
					}
				?>
				<input type="submit" value="Zapisz się" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
			</form>
		</div>
	</main>

	<?php include 'template/footer.php'; ?>
</body>
