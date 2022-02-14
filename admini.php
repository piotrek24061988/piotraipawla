<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container" style="min-height: 100vh;">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center">
			<?php
			
				if(!isset($_SESSION['user']))
				{
					header('Location: domowa');
				}
			
				echo "<p><b>Zalogowany jako: ".$_SESSION['user']."</b></p>";

				require_once "connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM admini";	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);

						$ile_adminow = $rezultat->num_rows;
						echo "</br><p><b>ilość adminów: ".$ile_adminow."</b><p>";	
echo<<<END
						<table class="d-flex align-items-center justify-content-center">
							<tr class="row">
								<th class="col-1">Id:</th>
								<th class="col-4">Login:</th>
								<th class="col-7">Email:</th>
							</tr>
END;
						  while($wiersz = $rezultat->fetch_assoc())
						  {
								echo '<tr class="row"><td class="col-1">'.$wiersz['id'].'</td><td class="col-4">'.$wiersz['name'].'</td><td class="col-7">'.$wiersz['email']."</tr>";
						  }					  						
echo<<<END
						</table>
END;
				
						$polaczenie->close();
					}
				}
				catch(Exception $e)
				{
					echo '<div class="text-danger"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
					exit();
				}			

			?>
			</div>
        </main>

		<?php include 'footer.php'; ?>
    </body>

</html>