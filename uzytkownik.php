<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container" style="min-height: 100vh;">
			<?php include 'scrollup.php'; ?>
			
			<?php
			
				echo "<p>Zalogowany jako: ".$_SESSION['user'];
			
			?>
        </main>

		<?php include 'footer.php'; ?>
    </body>

</html>