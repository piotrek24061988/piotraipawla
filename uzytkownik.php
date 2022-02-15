<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container"">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center">
			<?php
			
				if(!isset($_SESSION['user']))
				{
					header('Location: domowa');
				}
			
				echo "<p><b>Zalogowany jako: ".$_SESSION['user']."</b></p>";
				echo "<p><b>Twój email w systemie: ".$_SESSION['email']."</b></p>";
			
			?>
			</div>
        </main>

		<?php include 'footer.php'; ?>
    </body>

</html>