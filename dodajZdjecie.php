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
		<?php include 'header.php'; ?>
	</head>

    <body>
	
		<?php include 'menu.php'; ?>

        <main class="container">
			<?php include 'scrollup.php'; ?>
			
			<div class="bg-light mt-1 mb-5 content2 d-flex align-items-center justify-content-center row">
			<?php
				if(isset($_POST['submit']) && isset($_FILES['file']))
				{
					$img_name = $_FILES['file']['name'];
					$img_size = $_FILES['file']['size'];
					$tmp_name = $_FILES['file']['tmp_name'];
					$error = $_FILES['file']['error'];

					if($error == 0)
					{
						if($img_size > 10000000)
						{
							echo '<div class="col-12 text-danger text-center"><b>za duży plik</b></div>';
						}
						else if (($_POST['title'] == "") || ($_POST['description'] == ""))
						{
							echo '<div class="col-12 text-danger text-center"><b>dodaj tytyl i tresc</b></div>';
						}
						else
						{
							$title = $_POST['title'];
							$description = $_POST['description'];
							$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
							$img_ex_lc = strtolower($img_ex);

							$allowed_exs = array('jpg', 'jpeg', 'png');

							if(in_array($img_ex_lc, $allowed_exs)) {
								$new_img_name = uniqid("img-", true).'.'.$img_ex_lc;
								$upload_path = 'media/user/'.$new_img_name;
								move_uploaded_file($tmp_name, $upload_path);

								require_once "connect.php";
								mysqli_report(MYSQLI_REPORT_STRICT);
								try
								{
									$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
									if($polaczenie->connect_errno == 0)
									{
										$sql = sprintf("INSERT INTO zdjecia VALUES (NULL, '$title', '$new_img_name', '$description')"); 
										$rezultat = @$polaczenie->query($sql);

										if($rezultat)
										{
											echo '<div class="col-12 text-center text-success"><b>Zdjęcie dodane do galerii</b></div>';
										}
										else
										{
											throw new Exception($polaczenie->error);
										}	
								
										
										$polaczenie->close();
									}
								}
								catch(Exception $e)
								{
									echo '<div class="text-danger col-12 text-center"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
									exit();
								}
							}
							else {
								echo '<div class="col-12 text-danger text-center"><b>niedozwolony format</b></div>';
							}
							unset($_POST['submit']);
							unset($_FILES['file']);
						}
					}
					else
					{
						echo '<div class="col-12 text-danger text-center"><b>blad podczas ładowania pliku</b></div>';
					}

					unset($_POST['submit']);
					unset($_FILES['file']);
				}

				?>				
					<form method="post" enctype="multipart/form-data" class="col-12">
						<h3>Zdjęcie:</h3>
						<label for="title">Tytuł:</label>
						<input type="text" name="title" class="w-100"/> </br> 
						<label for="description">Treść:</label>
						<input type="text" name="description" class="w-100"/> </br> 
						<input type="file" name="file" class="mt-1 mb-1 w-100" style=""></br> 
						<input type="submit" value="Dodaj zdjęcie" name="submit" class="mt-1 mb-1"/>
					</form>
				
			</div>

        </main>

		<?php include 'footer.php'; ?>
    </body>