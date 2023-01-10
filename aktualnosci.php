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
			
				if (isset($_SESSION['aktualnosci']))
				{
					echo $_SESSION['aktualnosci'];
					unset($_SESSION['aktualnosci']);
				}
			
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM aktualnosci ORDER BY id DESC LIMIT 5";	
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
								echo '<td class="col-4"></td>';
								echo '<td class="col-4">'.'<a class="nodecoration" href="szczegolyAktualnosci?id='.$wiersz['id'].'"><b>'.$wiersz['tytul'].'</b></a></td>';
								echo '<td class="col-4">'.$wiersz['czas'].'</td>';
								echo '</tr>';
								if($wiersz['zdjecie1'])
								{
									echo '<tr class="row">';
									echo '<td class="col-3"></td>';
									echo '<td class="col-6">'.'<a class="nodecoration" href="szczegolyAktualnosci?id='.$wiersz['id'].'">'.'<img src="media/user/'.$wiersz['zdjecie1'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></a></td>';
									echo '<td class="col-3"></td>';
									echo '</tr>';
								}
								echo '<tr class="row mb-5"><td class="col-12"></td></tr>';
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