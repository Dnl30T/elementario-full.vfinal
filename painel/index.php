<?php
	include('../classes/management.php');
	include('../config.php');
	include('../classes/Painel.php');
	include('../classes/MySql.php');
	include('../classes/user.php');
	if(Painel::logado() == false){
		include('login.php');
	}else{
		include('main.php');
	}

?>