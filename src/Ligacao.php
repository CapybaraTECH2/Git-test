<?php 
require 'classe/mCadastro.php';
$usuario = '';
$email = '';
$Senha = '';

if(isset($_GET['edit'])){
    $aux = new mCadastro();
    $aux->cod_cadastro=(filter_input(INPUT_GET, 'edit'));
    $aux->carregar();
    $usuario = $aux->Usuário;
    $email = $aux->email;
    $Senha = $aux->Senha;
   
}
?>
<!DOCTYPE html>
<html>
    <head >
        <meta charset="UTF-8">
        <title>Cadastro Usuaário</title>  
        <link rel="stylesheet" 
           type="text/css" href="estilo/estilo.css" >      
    </head>
    <body>
    <h1>Cadastro Usuário</h1>
    <form method="post" action="Ligacao.php">
        <div style="text-align: center">
            <input type="hidden" id="codigo" name="codigo" 
                   value="<?php echo $cod_cadastro?>"/><br/>
            <label>
                Usuário: <br/>
                <input type="text" id="nome" name="nome" 
                       value="<?php echo $nome?>"/><br/>
            </label>
            <label>
                E-mail: <br/>
                <input type="text" id="email" name="email" 
                       value="<?php echo $email?>"/>
            </label><br/>
            <label> 
                Senha:<br/>
                <input type="text" id="senha" name="senha" 
                       value="<?php echo $Senha?>"/>
            </label><br/>
           
            </label><br/>
            <input type="submit" value="Atualizar" name="Editar"/>
        </div>
    </form>
    <?php
    
    if(isset($_POST['Deletar'])){
        $deleta = new mCadastro();
        $deleta->cod_cadastro=(filter_input(INPUT_POST, 'codigo'));
        $deleta->deletar();
    }
    
    if(isset($_POST['Editar'])){
        $dados = new mCadastro();
        $dados->$usuario=(filter_input(INPUT_POST, 'usuario'));
        $dados->email=(filter_input(INPUT_POST, 'email'));
        $dados->senha=(filter_input(INPUT_POST, 'senha'));
        $dados->$cod_cadastro=(filter_input(INPUT_POST, 'codigo'));
        $dados->atualizar();
    }
    ?>
    <footer>
            Todos os direitos reservados.
        </footer>
        <!-- Encerramento do rodapé-->
    </body>
</html>