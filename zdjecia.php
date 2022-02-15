<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 text-center">
			<?php
				require_once "connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM zdjecia";	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);

						$ile_zdjec = $rezultat->num_rows;
						echo "<p><b>ilość zdjęć: ".$ile_zdjec."</b><p>";	
echo<<<END
						<table class="d-flex align-items-center justify-content-center">
							<tr class="row">
								<th class="col-1">Id:</th>
								<th class="col-3">tytul:</th>
								<th class="col-4">zdjecie:</th>
								<th class="col-3">tresc:</th>
							</tr>
END;
						  while($wiersz = $rezultat->fetch_assoc())
						  {
								echo '<tr class="row">';
								echo '<td class="col-1">'.'<a href="szczegolyZdjecia.php?id='.$wiersz['id'].'">'.$wiersz['id'].'</a>'.'</td>';
								echo '<td class="col-3">'.$wiersz['tytul'].'</td>';
								echo '<td class="col-4"><img src="media/user/'.$wiersz['sciezka'].'" alt="proboszcz" class="img-fluid"/></td>';
								echo '<td class="col-3">'.$wiersz['tresc'].'</td>';
								echo '</tr>';
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