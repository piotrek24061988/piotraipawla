<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'template/header.php'; ?>
	</head>

    <body>
	
		<?php include 'template/menu.php'; ?>

        <main class="container">
			<?php include 'template/scrollup.php'; ?>
			
			<div class="bg-light mt-1 text-center content2">
			<?php
				@session_start();
			
				if (isset($_SESSION['pliki']))
				{
					echo $_SESSION['pliki'];
					unset($_SESSION['pliki']);
				}
			
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM pliki ORDER BY id DESC";	
						$rezultat = @$polaczenie->query($sql);
						if(!$rezultat) throw new Exception($polaczenie->error);
						
						$rezultaty_per_strona = 8;
						$ile_plikow = $rezultat->num_rows;
						$ile_stron = ceil($ile_plikow / $rezultaty_per_strona);	
						echo "<p><b>ilość plików w bazie: ".$ile_plikow."</b><p>";	
						
						$obecna_strona = 1;
						if(isset($_GET['strona'])) {
							$obecna_strona = $_GET['strona'];
						}
						
						$limit = ($obecna_strona - 1)*$rezultaty_per_strona;
						$sql = "SELECT * FROM pliki ORDER BY id DESC LIMIT ".$limit.",".$rezultaty_per_strona."";	
						$rezultat = @$polaczenie->query($sql);
						if(!$rezultat) throw new Exception($polaczenie->error);
echo<<<END
						<table class="d-flex align-items-center justify-content-center">
							<!--<tr class="row">
								<th class="col-4">id:</th>
								<th class="col-4">opis:</th>
								<th class="col-4">plik:</th>
							</tr>-->
END;
							while($wiersz = $rezultat->fetch_assoc())
							{
								echo '<tr class="row mb-1">';
								echo '<td class="col-12"><b>'.$wiersz['opis'].'</b></td>';
								echo '</tr>';
								echo '<tr class="row mb-3">';
								echo '<td class="col-5"></td>';
								echo '<td class="col-2">'.'<a href="media/files/'.$wiersz['sciezka'].'" download="">'.'<img src="media/download.png" alt="pobierz plik" class="img-fluid"/></a></td>';
								echo '<td class="col-3"></td>';
								echo '<td class="col-2">';
								if(isset($_SESSION['user']))
								{
									echo '<form action="kasujPlik?id='.$wiersz['id'].'" method="post">';
									echo '<input type="submit" value="kasuj" class="mt-1 mb-1 btn btn-danger text-dark font-weight-bold"/>';
									echo '</form>';
								}
								echo '</td>';
							}					  						
echo<<<END
						</table>
END;
								
						echo '<div class="mt-1 mb-1">';
						for($strona=1; $strona <= $ile_stron; $strona++)
						{
							echo '<a href="pliki?strona='.$strona.'"><button class="btn bg-light"><b>'.$strona.'</b></button><a/>';
						}
						echo '</div>';
				
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