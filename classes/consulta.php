<?php

require_once 'DB.php';

abstract class consulta extends DB{

    public function con(){
        return $conn = DB::conexao();
    }

    abstract public function insert();

    abstract public function update($id);
    
    
    public function findAll(){        
        $consulta = DB::conexao();
        $sql  = "SELECT * FROM telefones";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function deletar($id){
        $consulta = DB::conexao();
        $resul = $consulta->prepare("delete from telefones where id = ?");
        $resul->bindParam(1,$id);
        return $resul->execute();
    }

    public function findId($id){
        $consulta = DB::conexao();
        $result = $consulta->prepare("select * from telefones where id =?");
        $result->bindValue(1,$id);
        $result->execute();
        return $result->fetchAll();
    }

    public function validaLogin($user, $senha){
        $consulta = DB::conexao();
        $result = $consulta->prepare("SELECT COUNT(*) as cont FROM USUARIOS WHERE USER = ? and SENHA = ?");
        $result->bindValue(1,$user);
        $result->bindValue(2,$senha);
        $result->execute();
        return $result->fetchAll();
    }
    
    

}
/*
    $consulta = $conexao->query("select * from contatos");
    $consulta->execute();
    while($i = $consulta->nextRowset()){

    }*/
?>