<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	define('INCLUDE_PATH','http://localhost/elementario-full/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

	define('BASE_DIR_PAINEL',__DIR__.'/painel');


	//DB info
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','projeto_07');

	//CP constants
	define('NOME_EMPRESA','Elementario');

	function selecionadoMenu($par){
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}
	function modeloSemestral($instID,$param=null)
	{
		$sql = MySql::conectar()->prepare(
			"SELECT `modelo-semestral` FROM `instituicao` WHERE `id_professor` = $_SESSION[ID] AND `codigo_ins`=$instID"
		);
		$sql->execute();
		$data = $sql->fetchAll();
		foreach ($data as $key => $value) {
			$box = $value['modelo-semestral'];
		}
		switch ($box) {
			case 1:
				$nome = 'mês';
				for ($i=0; $i < round(8/$box); $i++) { 
					$semestre[$i] = $i;
				}
				break;
			case 2:
				$nome = 'bimestre';
				for ($i=0; $i < round(8/$box); $i++) { 
					$semestre[$i] = $i;
				}
				break;
			case 3:
				for ($i=0; $i < round(8/$box); $i++) { 
					$semestre[$i] = $i;
				}
				$nome = 'trimestre';
				break;
			default:
				for ($i=0; $i < round(8/$box); $i++) { 
					$semestre[$i] = $i;
				}
				$nome = 'outro modelo';
				break;
		}
		if($param==null){
			return $nome;
		}else if($param == 1){
			return $semestre;
		}else{
			return 'operação inválida';
		}
	}
	function getTypeTest($param){
		switch ($param) {
			case 1:
				echo 'Trabalho';
				break;
			case 2:
				echo 'Prova';
				break;
			case 3:
				echo 'Teste';
				break;
			case 4:
				echo 'Conceito';
				break;
			default:
				echo 'Outro';
				break;
		}
	}

?>