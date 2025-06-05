<?php 
require 'classe/conexao.php';


class mCadastro extends conexao{
    //put your code here    
    public $cod_cadastro;
    public $usuario;
    public $email;
    public $senha;
   
    //criando váriaveis de manipulação no banco
    protected $sqlInserir = "INSERT INTO usuario (usuario, e_mail, senha ) "
            . "VALUES ('%s','%s', '%s')";
    protected $sqlAtualizar = "UPDATE usuario set usuario='%s', "
            . "e_mail='%s', senha='%s',  "
            . "WHERE id = '%s'";
    protected $sqlDeletar = "DELETE FROM usuario "
            . "WHERE id = '%s'";
    protected $sqlSelecionar = "SELECT * FROM usuario WHERE 1=1 %s %s";
    
    public function inserir(){
        //preenche valores de dados
        $sql = sprintf($this->sqlInserir, 
                $this->usuario, $this->email, 
                $this->senha);
        return $this->RodaQuery($sql);
    }
    
    public function atualizar() {
        //preenche dados a serem atualizados
        $sql = sprintf($this->sqlAtualizar, $this->usuario, $this->email, 
                $this->senha,  $this->cod_cadastro);
        return $this->RodaQuery($sql);
        
    }
    
    public function deletar() {
        //preenche dados a serem atualizados
        $sql = sprintf($this->sqlDeletar, $this->cod_cadastro);
        return $this->RodaQuery($sql);
        
    }
    
    public function selecionar($where='',$order='') {
        //preenche dados a serem atualizados
        $sql = sprintf($this->sqlSelecionar, $where, $order);
        return $this->RodaSelect($sql);
        
    }   
    
    public function carregar() {
        //preenche dados a serem atualizados
        $rs = $this->selecionar(sprintf("and cod_cadastro = '%s'", $this->cod_cadastro));
        $this->cod_cadastro=$rs[0]['cod_cadastro'];              
        $this->email=$rs[0]['email'];
        $this->usuario=($rs[0]['usuario']);
        $this->senha=($rs[0]['senha']);  
        
        
        return $this;
        
    }
}
