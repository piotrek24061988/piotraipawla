<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
		<title>Logowanie</title>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center">
				<h3>Logowanie:</h3>
				<form action="zaloguj.php" method="post">
					Login:</br> <input type="text" name="login"/> </br> 
					Hasło:</br> <input type="password" name="haslo"/> </br> 
					<input type="submit" value="Zaloguj się" class="mt-1 mb-1"/>
				</form>
			</div>
        </main>

		<?php include 'footer.php'; ?>
    </body>
