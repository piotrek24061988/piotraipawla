<?php
	if(!isset($_GET['id']))
	{
		header('Location: ogloszeniaBiezace');
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
			
			<div class="bg-light mt-1 text-center content2">
			<?php
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if(($polaczenie->connect_errno == 0) && isset($_GET['id']))
					{
						$id = $_GET['id'];
						$sql = "SELECT * FROM aktualnosci WHERE id=".$id;	
						$rezultat = @$polaczenie->query($sql);

						if(!$rezultat) throw new Exception($polaczenie->error);

						$ile_zdjec = $rezultat->num_rows;
echo<<<END
						<table class="d-flex align-items-center justify-content-center mb-1">
							<!--<tr class="row mb-5">
								<th class="col-4">Id:</th>
								<th class="col-4">tytul:</th>
								<th class="col-4">czas:</th>
							</tr>-->
END;
						if($wiersz = $rezultat->fetch_assoc())
						{
							echo '<tr class="row mt-1">';
							//echo '<td class="col-4">'.$wiersz['id'].'</td>';
							echo '<td class="col-4"></td>';
							echo '<td class="col-4"><b>'.$wiersz['tytul'].'</b></td>';
							echo '<td class="col-4">'.$wiersz['czas'].'</td>';
							echo '</tr>';
							if($wiersz['zdjecie1'])
							{
								echo '<tr class="row">';
								echo '<td class="col-12 p-1 px-5">'.'<img src="media/user/'.$wiersz['zdjecie1'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></td>';
								echo '</tr>';
							}
							if($wiersz['tresc1'])
							{
								echo '<tr class="row mb-1">';
								echo '<td class="col-12 p-1 px-5 text-justify textareatext"><h3>'.$wiersz['tresc1'].'</h3></td>';
								echo '</tr>';
							}
							if($wiersz['zdjecie2'])
							{
								echo '<tr class="row">';
								echo '<td class="col-12 p-1 px-5">'.'<img src="media/user/'.$wiersz['zdjecie2'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></td>';
								echo '</tr>';
							}
							if($wiersz['tresc2'])
							{
								echo '<tr class="row mb-1">';
								echo '<td class="col-12 p-1 px-5 text-justify textareatext"><h3>'.$wiersz['tresc2'].'</h3></td>';
								echo '</tr>';
							}
							if($wiersz['zdjecie3'])
							{
								echo '<tr class="row">';
								echo '<td class="col-12 p-1 px-5">'.'<img src="media/user/'.$wiersz['zdjecie3'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></td>';
								echo '</tr>';
							}
							if($wiersz['tresc3'])
							{
								echo '<tr class="row mb-1">';
								echo '<td class="col-12 p-1 px-5 text-justify textareatext"><h3>'.$wiersz['tresc3'].'</h3></td>';
								echo '</tr>';
							}
							if($wiersz['zdjecie4'])
							{
								echo '<tr class="row">';
								echo '<td class="col-12 p-1 px-5">'.'<img src="media/user/'.$wiersz['zdjecie4'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></td>';
								echo '</tr>';
							}
							if($wiersz['tresc4'])
							{
								echo '<tr class="row mb-1">';
								echo '<td class="col-12 p-1 px-5 text-justify textareatext"><h3>'.$wiersz['tresc4'].'</h3></td>';
								echo '</tr>';
							}
							if($wiersz['zdjecie5'])
							{
								echo '<tr class="row">';
								echo '<td class="col-12 p-1 px-5">'.'<img src="media/user/'.$wiersz['zdjecie5'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></td>';
								echo '</tr>';
							}
							if($wiersz['tresc5'])
							{
								echo '<tr class="row mb-1">';
								echo '<td class="col-12 p-1 px-5 text-justify textareatext"><h3>'.$wiersz['tresc5'].'</h3></td>';
								echo '</tr>';
							}
						}	

						if(isset($_SESSION['user']))
						{
							echo '<tr class="row">';
							echo '<td class="col-6">';
							echo '<form action="kasujAktualnosci?id='.$id.'" method="post">';
							echo '<input type="submit" value="kasuj" class="mt-1 mb-1 btn btn-danger text-dark font-weight-bold"/>';
							echo '</form>';
							echo '</td>';
							echo '<td class="col-6">';
							echo '<form action="aktualizujAktualnosci?id='.$id.'" method="post">';
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