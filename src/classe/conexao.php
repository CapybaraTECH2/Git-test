<?php

class conexao{
    
    //Define as váriaveis
    private $HOST = '127.0.0.1';
    private $USER = 'root';
    private $PASS = '';
    private $BD = 'PGA';
    
    //Cria conexão
    public function Conexao(){
        
        try{
            $con = new PDO("mysql:host=$this->HOST;"
                    . "dbname=$this->BD",$this->USER, $this->PASS);
            $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
            $con->exec("set names utf8");
            return $con;

        }catch(PDOexception $e){
            echo "Erro: ".$e->getMessage();
        }    
    }
    
    //Executa query`s de update, delete, insert
    public function RodaQuery($sql){
        $stm = $this->Conexao()->prepare($sql);
        return $stm->execute();
    }
    
    //Executa query`s de select, como exige retorno de lista deve ser diferenciada
    public function RodaSelect($sql){
        try{
            $stm = $this->Conexao()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }  catch(Exception $exception){
         echo 'Erro:'.$exception;
        }
    }
}