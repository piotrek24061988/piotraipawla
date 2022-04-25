<?php
	@session_start();

	if(isset($_POST['email'])) {
		
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		if(!$email){
			$_SESSION['e_email'] = 'niepoprawny email';
			header('Location: newsletter');
			exit();
		}
	}		
	else {
		header('Location: newsletter');
		exit();
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
			require_once "template/connect.php";
			try
			{
				$db = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password,
				              [PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
				
				if(isset($_POST['email'])) {
					
					$query = $db->prepare('SELECT * FROM newsletter WHERE email=:email');
					$query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
					$query->execute();
					$result = $query->fetchAll();
					
					if(!$result) {
						$query = $db->prepare('INSERT INTO newsletter VALUES (NULL, :email)');
						$query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
						$query->execute();
					}
				}		
			}
			catch(PDOException $e)
			{
				exit('Nie można połączyć się z bazą');
			}
?>

			<p>Dziękujemy za zapisanie się na listę mailową naszego newslattera</p>
		</div>
	</main>

	<?php include 'template/footer.php'; ?>
</body>