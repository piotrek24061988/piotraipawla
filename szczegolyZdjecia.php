<?php
	if(!isset($_GET['id']))
	{
		header('Location: zdjecia');
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
			
			<div class="bg-light mt-1 text-center">
			<?php
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if(($polaczenie->connect_errno == 0) && isset($_GET['id']))
					{
						$id = $_GET['id'];
						$sql = "SELECT * FROM zdjecia WHERE id=".$id;	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);

						$ile_zdjec = $rezultat->num_rows;
echo<<<END
						<table class="d-flex align-items-center justify-content-center">
							<!--<tr class="row">
								<th class="col-2">Id:</th>
								<th class="col-8">zdjecie:</th>
								<th class="col-2">tytul:</th>
							</tr>-->
END;
						if($wiersz = $rezultat->fetch_assoc())
						{
							echo '<tr class="row">';
							echo '<td class="col-12"><b>'.$wiersz['tytul'].'</b></td>';
							echo '</tr>';
							echo '<tr class="row p-5">';
							//echo '<td class="col-2">'.$wiersz['id'].'</td>';
							echo '<td class="col-12"><img src="media/user/'.$wiersz['sciezka'].'" alt="proboszcz" class="img-fluid"/></td>';
							//echo '<td class="col-2">'.$wiersz['tytul'].'</td>';
							echo '</tr>';
							echo '<tr class="row mb-5">';
							echo '<td class="col-12">'.$wiersz['tresc'].'</td>';
							echo '</tr>';
						}	

						if(isset($_SESSION['user']))
						{
							echo '<tr class="row">';
							echo '<td class="col-6">';
							echo '<form action="kasujZdjecie?id='.$id.'" method="post">';
							echo '<input type="submit" value="kasuj" class="mt-1 mb-1 btn btn-danger text-dark font-weight-bold"/>';
							echo '</form>';
							echo '</td>';
							echo '<td class="col-6">';
							echo '<form action="aktualizujZdjecie?id='.$id.'" method="post">';
							echo '<input type="submit" value="aktualizuj" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>';
							echo '</form>';
							echo '</td>';
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

		<?php include 'template/footer.php'; ?>
    </body>

</html>