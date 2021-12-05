<?php
    class Management{

        protected $id;

        public function infoExists($table)
        {
            $sql = MySql::conectar()->query(
                "SELECT * FROM `$table` WHERE id_professor = $_SESSION[ID]"
            );
            $answer = $sql->fetchAll();
            //print_r($answer);
            if ($answer != null) {
                //echo "real";
                return true;     
            }else{
                //echo "faiki";
                return false;
            }
        }
        protected function insertIntoClass($studentName,$classId,$id = null){
            if ($id == null) {
                $id = $_SESSION['ID'];
            }
            $sql = MySql::conectar()->query(
                "SELECT id_alu FROM `alunos` WHERE nome_alu = '$studentName'"
            );
            $getStudentId = $sql->fetchAll();
            foreach ($getStudentId as $key => $value) {
                $studentId = $value['id_alu'];
            }
            $sql = MySql::conectar()->prepare(
                "INSERT INTO `conter` (`codigo_tur`, `id_aluno`, `id_professor`) VALUES (?,?,?)"
            );
            $sql->execute(array($classId,$studentId,$id));
        }
    }
    
    class signUpManagement extends Management{

        public function newInst($name,$targetScore,$semMod,$id = null){
            if ($id == null) {
                $id = $_SESSION['ID'];
            }
            $sql = MySql::conectar()->prepare(
                "INSERT INTO instituicao (nome_ins,id_professor,codigo_ins,`modelo-semestral`,media) VALUES (?,?,?,?,?)"
            );
            $sql->execute(array($name,$id,null,$semMod,$targetScore));
            echo "sucesso";
        }
        public function newClassroom($name,$inst,$id = null){
            if ($id == null) {
                $id = $_SESSION['ID'];
            }
            $sql = MySql::conectar()->prepare(
                "INSERT INTO turmas (nome_tur,codigo_tur,cod_instituicao,id_professor) VALUES (?,?,?,?)"
            );
            $sql->execute(array($name,null,$inst,$id));
            echo "sucesso";
        }
        public function newStudent($name,$class,$number = null,$id = null){
            if ($id == null) {
                $id = $_SESSION['ID'];
            }
            $sql = MySql::conectar()->prepare(
                "INSERT INTO alunos (nome_alu,id_alu,id_professor,numero_alu) VALUES (?,?,?,?)"
            );
            $sql->execute(array($name,null,$id,$number));
            $this->insertIntoClass($name,$class);
        }
        public function newSubject($name){
            $sql = MySql::conectar()->prepare(
                "INSERT INTO disciplinas (nome_dis,id_professor) VALUES (?,?) "
            );
            $sql->execute(array($name,$_SESSION['ID']));
        }
    }
    class showInfo extends Management
    {
        public function showDataFilter($tables,$IdE=null,$idOp=null,$filter = null)
        {
            if ($idOp == 1) {
                $sql = MySql::conectar()->query(
                    "SELECT * 
                    FROM `alunos` a,`conter` c
                    WHERE id_aluno = id_alu
                    AND c.codigo_tur = $IdE
                    AND a.id_professor = $_SESSION[ID]
                    ORDER BY nome_alu ASC"
                );
                //print_r($sql);
                $fix = $sql->fetchAll();
                return $fix;
            }
            else if ($idOp == 2) {
                $sql = MySql::conectar()->query(
                    "SELECT *
                    FROM turmas t
                    WHERE t.cod_instituicao = $IdE
                    AND t.id_professor = $_SESSION[ID]
                    ORDER BY nome_tur"
                );
                //print_r($sql);
                $fix = $sql->fetchAll();
                return $fix;
            }else if ($filter != null) {
                $sql = MySql::conectar()->query(
                    "SELECT * FROM `$tables`WHERE id_professor = $_SESSION[ID] ORDER BY $filter"
                );
                return $sql->fetchAll();
            }else{
                $sql = MySql::conectar()->query(
                    "SELECT * FROM `$tables`WHERE id_professor = $_SESSION[ID]"
                );
                return $sql->fetchAll();
            }
        }
    }
    
    
?>