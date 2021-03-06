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

        <main class="container">
			<?php include 'template/scrollup.php'; ?>
			
			<div class="bg-light mt-1 content text-center">
			<?php
				echo "<p><b>Zalogowany jako: ".$_SESSION['user']."</b></p></br>";

				require_once "template/connect.php";
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
						
						echo "<p><b>ilość adminów: ".$ile_adminow."</b></p>";	
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
							echo '<tr class="row"><td class="col-1">'.$wiersz['id'].'</td><td class="col-4">'.$wiersz['name'].'</td><td class="col-7">'.$wiersz['email']."</td></tr>";
						}					  						
						echo "</table>";
						
						$sql = "SELECT * FROM newsletter";	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);

						$ile_subskrybentow = $rezultat->num_rows;
						
						echo "</br></br><p><b>ilość subskrybentów: ".$ile_subskrybentow."</b></p>";	
echo<<<END
						<table class="d-flex align-items-center justify-content-center">
							<tr class="row">
								<th class="col-4">Id:</th>
								<th class="col-8">Email:</th>
							</tr>
END;
						while($wiersz = $rezultat->fetch_assoc())
						{
							echo '<tr class="row"><td class="col-4">'.$wiersz['id'].'</td><td class="col-8">'.$wiersz['email']."</td></tr>";
						}					  						
						echo "</table>";
						
						$sql = "SELECT * FROM logowania ORDER BY id DESC LIMIT 10";	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);
						
echo<<<END
						</br></br>
						<p><b>ostatnie logowania:</b></p>
						<table class="d-flex align-items-center justify-content-center">
							<tr class="row">
								<th class="col-6">Admin:</th>
								<th class="col-6">Czas:</th>
							</tr>
END;
						while($wiersz = $rezultat->fetch_assoc())
						{
							$rezultat2 = @$polaczenie->query(sprintf("SELECT * FROM admini WHERE id='%d'", $wiersz['kto']));
							if(!$rezultat2) throw new Exception($polaczenie->error);
							echo '<tr class="row"><td class="col-6">'.$rezultat2->fetch_assoc()['name'].'</td><td class="col-6">'.$wiersz['kiedy'].'</td></tr>';
						}					  						
						echo "</table>";
				
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

		<?php include 'template/footer.php'; ?>
    </body>

</html>