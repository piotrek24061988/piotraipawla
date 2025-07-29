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
			
				if (isset($_SESSION['biezace']))
				{
					echo $_SESSION['biezace'];
					unset($_SESSION['biezace']);
				}
			
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM ogloszenia ORDER BY id DESC";	
						$rezultat = @$polaczenie->query($sql);
						if(!$rezultat) throw new Exception($polaczenie->error);
						
						$rezultaty_per_strona = 10;
						$ile_zdjec = $rezultat->num_rows;
						$ile_stron = ceil($ile_zdjec / $rezultaty_per_strona);	
						
						$obecna_strona = 1;
						if(isset($_GET['strona'])) {
							$obecna_strona = $_GET['strona'];
						}
						
						$limit = ($obecna_strona - 1)*$rezultaty_per_strona;
						$sql = "SELECT * FROM ogloszenia ORDER BY id DESC LIMIT ".$limit.",".$rezultaty_per_strona."";	
						$rezultat = @$polaczenie->query($sql);
						if(!$rezultat) throw new Exception($polaczenie->error);
echo<<<END
						<table class="d-flex align-items-center justify-content-center">
							<!--<tr class="row mb-5">
								<th class="col-4">id:</th>
								<th class="col-4">tytul:</th>
								<th class="col-4">czas:</th>
							</tr>-->
END;
							while($wiersz = $rezultat->fetch_assoc())
							{
								echo '<tr class="row">';
								//echo '<td class="col-4">'.'<a class="nodecoration" href="szczegolyBiezacych?id='.$wiersz['id'].'">'.$wiersz['id'].'</a></td>';
								//echo '<td class="col-4"></td>';
								echo '<td class="col-12">'.'<a class="nodecoration" href="szczegolyBiezacych?id='.$wiersz['id'].'"><b>'.$wiersz['tytul'].'</b></a></td>';
								//echo '<td class="col-4">'.$wiersz['czas'].'</td>';
								echo '</tr>';
								if($wiersz['zdjecie'])
								{
									echo '<tr class="row">';
									echo '<td class="col-1"></td>';
									echo '<td class="col-10">'.'<a class="nodecoration" href="szczegolyBiezacych?id='.$wiersz['id'].'">'.'<img src="media/user/'.$wiersz['zdjecie'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></a></td>';
									echo '<td class="col-1"></td>';
									echo '</tr>';
								}
								echo '<tr class="row mb-5"><td class="col-12"></td></tr>';
							}					  						
echo<<<END
						</table>
END;
								
						echo '<div class="mt-1 mb-1">';
						for($strona=1; $strona <= $ile_stron; $strona++)
						{
							echo '<a href="ogloszeniaBiezace?strona='.$strona.'"><button class="btn bg-light"><b>'.$strona.'</b></button><a/>';
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