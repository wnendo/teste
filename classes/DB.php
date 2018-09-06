<?php

class DB{

    public function conexao()
    {
        $con ="";
        try {
            $con = new PDO("mysql:host=localhost;dbname=plataforma", "root", "");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $con;
    }
}
?>
