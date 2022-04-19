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
				echo "<p>Obecna data: ".date('Y-m-d H:i:s')."</p>";
			
				echo "<p><b>Zalogowany jako: ".$_SESSION['user']."</b></p>";

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
						
						echo "</br>";
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
echo<<<END
						</table>
END;
						$sql = "SELECT * FROM logowania ORDER BY id DESC LIMIT 10";	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);
						
echo<<<END
						</br></br>
						<p><b>ostatnie logowania:</b></p>
						<table class="d-flex align-items-center justify-content-center">
							<tr class="row">
								<th class="col-6">Id:</th>
								<th class="col-6">Time:</th>
							</tr>
END;
						  while($wiersz = $rezultat->fetch_assoc())
						  {
								echo '<tr class="row"><td class="col-6">'.$wiersz['kto'].'</td><td class="col-6">'.$wiersz['kiedy'].'</td></tr>';
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

		<?php include 'template/footer.php'; ?>
    </body>

</html>