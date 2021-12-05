<?php include('config.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo NOME_EMPRESA; ?></title>
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	<link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet" />
	<link href="<?php echo INCLUDE_PATH; ?>css/main.css" rel="stylesheet" />
	<link href="<?php echo INCLUDE_PATH; ?>css/home.css" rel="stylesheet" />
	<link href="<?php echo INCLUDE_PATH; ?>css/cad-log.css" rel="stylesheet" />
	<link href="<?php echo INCLUDE_PATH; ?>css/contato.css" rel="stylesheet" />

	<link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>images/atomo.ico" type="image/x-icon">
	<meta charset="utf-8" />
</head>

<body>
	<div id="container">
		<base base="<?php echo INCLUDE_PATH; ?>" />
		<?php
			$url = isset($_GET['url']) ? $_GET['url'] : 'home';
			
		?>
		<div class="sucesso">Formulario Enviado</div>
		<div class="overlay-loading">
			<img src="<?php echo INCLUDE_PATH; ?>images/ajax-loader.gif" alt="">
		</div>

		<header>

			<input type="checkbox" id="checar">

			<a href="<?php echo INCLUDE_PATH; ?>" target="_self">
				<div class="logo">
					<img src="<?php echo INCLUDE_PATH; ?>/src/atomo.png">
					<span>Elementari-o</span>
				</div>
			</a>

			<nav>
				<ul class="nav_pages">
					<a href="<?php echo INCLUDE_PATH; ?>" target="_self">
						<li>Início</li>
					</a>

					<a href="<?php echo INCLUDE_PATH; ?>cadastro" target="_self">
						<li>Cadastrar</li>
					</a>

					<a href="<?php echo INCLUDE_PATH_PAINEL; ?>" target="_self">
						<li>Login</li>
					</a>

					<a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">
						<li>Contato</li>
					</a>
				</ul>
			</nav>

			<label for="checar">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</label>
		</header>

		<div>
			<?php

			if (file_exists('pages/' . $url . '.php')) {
				include('pages/' . $url . '.php');
			} else {
				include('pages/404.php');
			}

			?>
		</div>

		<footer>
            <p>Elementari-o Ltda. - Todos os Direitos Reservados</p>
			<p>Elementari-o Ltda. - All Rights Reserved</p>
        </footer>
	</div>
</body>

</html>