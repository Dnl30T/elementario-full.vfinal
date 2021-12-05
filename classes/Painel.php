<?php
    class Painel{

        public static function logado(){
			return isset($_SESSION['login']) ? true : false;
		}

        public static function logout(){
			session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
		}

		public static function deleteFile($file){
			@unlink('uploads/'.$file);
		}



		public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'imagem/jpg' ||
				$imagem['type'] == 'imagem/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho < 300)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}
		public static function uploadFile($file){
			$formatoArquivo = explode('.',$file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
				return $imagemNome;
			else
				return false;
		}

		public static function carregarPagina(){
			if(isset($_GET['url'])){
				$url = explode('/',$_GET['url']);
				if(file_exists('pages/'.$url[0].'.php')){
					include('pages/'.$url[0].'.php');
				}else{
					//Página não existe!
					include('pages/overview.php');
				}
			}else{
				include('pages/overview.php');
			}
		}
		public static function alert($tipo,$mensagem){
			if($tipo == 'sucesso'){
				echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
			}else if($tipo == 'erro'){
				echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
			}
		}
		public static function selectAll($tabela,$start = null,$end = null){
			if($start == null && $end == null)
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
			else
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC LIMIT $start,$end");
	
			$sql->execute();

			
			return $sql->fetchAll();

		}
		public static function selectUsersById($id){
			$sql = MySql::conectar()->prepare("SELECT * FROM `usuario` WHERE `id_usu` = $id");
			$sql->execute();
			return $sql->fetchAll();

		}
		public static function deleteRegister($table,$id)
		{
			$sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE  id_usu = $id");
			$sql->execute();
		}
		public static function deleteStudent($table,$id)
		{
			$sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE  id_alu = $id");
			$sql->execute();
		}
		public static function deleteSubject($table,$id)
		{
			$sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE  codigo_dis = $id");
			$sql->execute();
		}
		public static function deleteClass($table,$id)
		{
			$sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE  `codigo_tur` = $id");
			$sql->execute();
		}
		public static function deleteSchool($table,$id)
		{
			$sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE  `codigo_ins` = $id");
			$sql->execute();
		}
		public static function deleteTest($table,$id)
		{
			$sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE  `codigo_ava` = $id");
			$sql->execute();
		}
    }
?>