<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container" style="min-height: 100vh;">
			<?php include 'scrollup.php'; ?>
			<?php include 'mousemove.php'; ?>
<?php
			if(isset($_SESSION['rejestracja']))
			{
				echo '<div class="bg-light mt-1 content text-center">Udana rejestracja - można się zalogować na konto nowego użytkownika</div>';
				unset($_SESSION['rejestracja']);
			}
?>
        </main>

		<?php include 'footer.php'; ?>
    </body>

</html>