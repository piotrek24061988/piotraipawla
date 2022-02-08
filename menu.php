<?php

	session_start();
	
echo<<<END
	<header class="site-header col-12">
		<div class="row topcontent bg-light">
			<img src="media/pip5.jpg" alt="ołtarz" class="col-12 col-md-2 bg-light topimg"/>
			<div class="col-12 col-md-8 bg-light d-flex align-items-center justify-content-center">
			<h1>Parafia Św. Apostołów Piotra i Pawła w Bydgoszczy</h1>
			</div>
			<img src="media/pip4.jpg" alt="ołtarz" class="col-12 col-md-2 bg-light topimg"/>
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<button class="navbar-toggler mr-auto ml-auto" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<img style="width: auto; height: 100%;" src="media/pp.jpg" alt="przycisk rozwijanej nawigacji"/>
					</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarToggle">
					<div class="navbar-nav mr-auto ml-auto">
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="domowa">Głowna</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Kontakt</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="parafia">Parafia</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Ogłoszenia</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Galeria</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Sakramenty</a>
						<a class="btn btn-light w-100 mx-1 font-weight-bold" href="#">Stowarzyszenia</a>
						<div class="nav-item dropdown">
							<button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Dodatkowo
							</button>
							<div class="dropdown-menu bg-light ml-1" aria-labelledby="subnav">
								<a class="dropdown-item bg-light font-weight-bold" href="#">Dodatkowo 1</a>
								<a class="dropdown-item bg-light font-weight-bold" href="#">Dodatkowo 2</a>
								<a class="dropdown-item bg-light font-weight-bold" href="#">Dodatkowo 3</a>
							</div>
						</div>
END;
						if(!isset($_SESSION['user']))
						{
							echo<<<END
								<a class="btn btn-light w-100 mx-1 font-weight-bold" href="logowanie">Logowanie</a>
							END;
						}
						else
						{
							echo<<<END
								<a class="btn btn-light w-100 mx-1 font-weight-bold mr-auto" href="wyloguj">Wylogowanie</a>
							END;
						}
echo<<<END
					</div>
				</div>
			</div>
		</nav>
	</header>

END;
?>