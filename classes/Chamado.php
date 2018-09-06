<?php
require_once 'consulta.php';
class Chamado extends consulta{

    private var $id;
    private $nome;
    private $telefone;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function insert()
    {

        $insert = consulta::con();
        $param = $insert->prepare("insert into telefones (nome,telefone) VALUES (?,?)");
        $param->bindValue(1,$this->nome);
        $param->bindValue(2,$this->telefone);

        return $param->execute();
    }

    public function update($id){
        $update = consulta::con();
        $param = $insert->prepare("update telefones set nome=?,telefone=? where id=?");
        $param->bindValue(1,$this->nome);
        $param->bindValue(2,$this->telefone);
        $param->bindValue(3,$id);
        return $param->execute();
    }
    

}