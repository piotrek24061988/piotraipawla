<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'template/header.php'; ?>
	</head>

    <body>
	
		<?php include 'template/menu.php'; ?>

        <main class="container" style="min-height: 100vh;">
			<?php include 'template/scrollup.php'; ?>
			<?php include 'template/mousemove.php'; ?>
			
			<?php
				@session_start();
			
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
							$counter = 1;
							while($wiersz = $rezultat->fetch_assoc())
							{
								echo '<div class="aktualnosc text-center glownezdjecia bg-white" id="aktualnosc'.$counter.'">';
								if($wiersz['zdjecie1'])
								{
									echo '<a class="nodecoration text-black" href="szczegolyAktualnosci?id='.$wiersz['id'].'"><b>'.$wiersz['tytul'].'</b></a>';
									echo '<a class="nodecoration text-black float-right" href="szczegolyAktualnosci?id='.$wiersz['id'].'"><small>'.$counter.'/5</small></a>';
									echo '<a class="nodecoration" href="szczegolyAktualnosci?id='.$wiersz['id'].'">'.'<img src="media/user/'.$wiersz['zdjecie1'].'" alt="'.$wiersz['tytul'].'" class="img-fluid news-img"/></a>';
								}
								echo '</div>';
								$counter++;
							}					  						
				
						$polaczenie->close();
					}
				}
				catch(Exception $e)
				{
					echo '<div class="text-danger"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
					exit();
				}			
			?>
        </main>

		<?php include 'template/footer.php'; ?>
    </body>

</html>