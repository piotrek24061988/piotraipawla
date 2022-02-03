<?php
	
echo<<<END

	<header class="site-header">
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<img style="width: auto; height: 100%;" src="media/pp.jpg" alt="przycisk rozwijanej nawigacji"/>
					</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarToggle">
					<div class="navbar-nav mr-auto">
						<a class="btn btn-light w-100 mx-1" href="index.php">Głowna</a>
						<a class="btn btn-light w-100 mx-1" href="#">Kontakt</a>
						<a class="btn btn-light w-100 mx-1" href="historia_parafii.php">Parafia</a>
						<a class="btn btn-light w-100 mx-1" href="#">Ogłoszenia</a>
						<a class="btn btn-light w-100 mx-1" href="#">Galeria</a>
						<a class="btn btn-light w-100 mx-1" href="#">Sakramenty</a>
						<a class="btn btn-light w-100 mx-1" href="#">Stowarzyszenia</a>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Dodatkowo
							</button>
							<div class="dropdown-menu bg-light ml-1" aria-labelledby="subnav">
								<a class="dropdown-item bg-light" href="#">Dodatkowo 1</a>
								<a class="dropdown-item bg-light" href="#">Dodatkowo 2</a>
								<a class="dropdown-item bg-light" href="#">Dodatkowo 3</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>

END;
?>