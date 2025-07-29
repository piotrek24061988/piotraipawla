<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'template/header.php'; ?>
	</head>

    <body>
	
		<?php include 'template/menu.php'; ?>

        <main class="container">
			<?php include 'template/scrollup.php'; ?>
			
			<div class="bg-light mt-1 content2 mb-1 p-5">
			<?php
				@session_start();
			
				if (isset($_SESSION['stale']))
				{
					echo $_SESSION['stale'];
					unset($_SESSION['stale']);
				}
			
				require_once "template/connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
					if($polaczenie->connect_errno == 0)
					{
						$sql = "SELECT * FROM memo ORDER BY id DESC LIMIT 1";	
						$rezultat = @$polaczenie->query($sql);
						if(!$rezultat) throw new Exception($polaczenie->error);
echo<<<END
						<table class="text-left font-weight-bold">
							<!--<tr class="row">
								<th class="col-1">id:</th>
								<th class="col-9">tresc:</th>
								<th class="col-3">czas:</th>
							</tr>-->
END;
							if($wiersz = $rezultat->fetch_assoc())
							{
								echo '<tr class="row">';
								//echo '<td class="col-1">'.$wiersz['id'].'</td>';
								echo '<td class="col-12 textareatext"><h3>'.$wiersz['text'].'</h3></td>';
								//echo '<td class="col-3 font-weight-normal">'.$wiersz['czas'].'</td>';
								echo '</tr>';
								
								if(isset($_SESSION['user']))
								{
									echo '<tr class="row">';
									echo '<td class="col-12 text-center">';
									echo '<form action="aktualizujStale" method="post">';
									echo '<input type="submit" value="aktualizuj" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>';
									echo '</form>';	
									echo '</td>';										
									echo '</tr>';									
								}
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