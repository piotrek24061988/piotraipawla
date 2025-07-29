<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<?php include 'template/header.php'; ?>
	</head>

    <body>
	
		<?php include 'template/menu.php'; ?>

        <main class="container">
			<?php include 'template/scrollup.php'; ?>
			
			<?php
				if(isset($_POST['submit']))
				{
					$title = $_POST['title'];
					$description = $_POST['description'];
						
					require_once "template/emails.php";
					
					$headers = array(
									'From' => 'piotraipawla web page',
									'Reply-To' => $email_secondary,
								    'Content-type' => 'text/plain; charset=utf-8',
									'X-Mailer' => 'PHP/' . phpversion()
					);
					if($title && $description) {
						$status = mail($email_pip.';'.$email_secondary, $title, $description, $headers);
						if($status) {
							echo '<div class="col-12 mt-1 text-center text-success bg-light"><b>Wiadomość została wysłana</b></div>';
						}
					}
				}
			?>	
			
			<h3 class="bg-light mt-1 mb-1 content2 p-5 text-center wordwrap">
				
				<b>Parafia pw. Św. Apostołów Piotra i Pawła</b><br/>
				85-007 Bydgoszcz<br/>
				Plac Wolności<br/>
				<br/>
				<b>Plebania:</b><br/>
				ul. Mikołaja Reja 3<br/>
				tel. 52-328 64 80<br/>
				<br/>
				<b>W sprawach pilnych:</b><br/>
				Kapłan dyżurny<br/>
				tel. 887 098 787<br/>
				<br/>
				<b>W internecie:</b><br/>
				<b>strona:</b> <a href="https://piotraipawla.bydgoszcz.pl" target="_blank"" class="nodecoration">https://piotraipawla.bydgoszcz.pl</a><br/>
				<b>email:</b> ryszardszymkowiak@wp.pl<br/>
				<br/>
				<b>Konto Bankowe:</b><br/>
				Bank PKO S.A. II O/Bydgoszcz<br/>
				Nr konta 91 12 40 34 93 11 11 00 00 43 05 90 12<br/> 

			</h3>
			
			<form class="bg-light mt-1 mb-1 content2 p-5 text-center" method="post" enctype="multipart/form-data" class="col-12">
				<h3><b>Napisz do nas:</b></h3>
				<h3><label for="title">Tytuł:</label></h3>
				<input type="text" name="title" class="w-100"/> </br>
				</br>
				<h3><label for="description">Treść:</label></h3>
				<textarea rows="8" style="width: 100%;" name="description"></textarea>
				<input type="submit" value="Wyślij wiadomość" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
				<h6>*W przypadku korzystania z formularza kontaktowego zaleca się dopisywać dane do kontaktu zwrotnego.</h6>
				<h6>*Staramy się ustosunkowywać do zgłaszanych błędów, usterek i sugestii dotyczących strony internetowej.</h6>

			</form>

			<h5 class="bg-light content2 text-center">
				autor:
				<a href="https://www.twojkomputerowiec.bydgoszcz.pl" target="_blank"" class="nodecoration">
					<img src="media/PG.png" alt="Piotr Górecki" class="bg-light mylogo"/>Piotr Górecki
				</a>
			</h5>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>