<?php
	@session_start();

	if(!isset($_SESSION['user']))
	{
		header('Location: domowa');
	}
?>
<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'template/header.php'; ?>
	</head>

    <body>
	
		<?php include 'template/menu.php'; ?>

        <main class="container"">
			<?php include 'template/scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center">
			<?php
				echo "<p><b>Zalogowany jako: ".$_SESSION['user']."</b></p>";
				echo "<p><b>Twój email w systemie: ".$_SESSION['email']."</b></p>";
			
			?>
			</div>
        </main>

		<?php include 'template/footer.php'; ?>
    </body>

</html>