<?php 
require 'classe/mCadastro.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
        <meta charset="UTF-8">
        <title>Cadastro Usuário</title>
        <link rel="stylesheet" 
           type="text/css" href="estilo/estilo.css" >
    </head>
</head>
<body>
    
 
       <h1 style="text-align: center">Cadastro Usuário</h1>
            <form method="post" action="index.php?p=cadastro">
                <div style="text-align: center">
                    <input type="hidden" id="codigo" name="codigo"/><br/>
                    
                    <label>
                        Usuário: 
                        <input type="text" id="usuario" name="usuario"/>
                    </label>
                    <br></br>
                    <label>
                        E-mail: 
                        <input type="text" id="email" name="email"/>
                    </label>
                     <br></br>
                    <label> 
                        Senha:
                        <input type="password" id="senha" name="senha"/>
                    </label>
                     <br></br>
                    <label>  
                    <input type="submit" value="Cadastra"/>
                    
                </div>
            </form>
                <br></br>
             <table style="margin: auto" id="tabelaCont" border="1">
                <tr>
                    <th>Usuário</th>
                    <th>E-mail</th>               
                </tr>
                <?php 
                $consulta = new mCadastro();
                $lista = $consulta->selecionar();
                foreach ($lista as $cadastra) {  ?>
                <tr>
                    <td><?php echo $cadastra['usuario']; ?>
                    </td>
                    <td><?php echo $cadastra['e_mail']; ?>
                    </td>
                    
                    
                    <td><button onclick="atualizar(<?php echo("{$cadastra['id']}")?>)">Editar</button>   
                        |  <button onclick="deletar(<?php echo"{$cadastra['id']}"?>)">Deletar</button>
                  
                </tr>
                <?php }?>
            </table>
            </section>
        
        <!-- Encerramento do conteúdo-->
        <footer>
            Todos os direitos reservados.
        </footer>
        <!-- Encerramento do rodapé-->
    </body>
</html>

<script type="text/javascript">

     function deletar(id) {
        var apagar = confirm('Você deseja excluir este registro?');
        if (apagar){
            location.href = '?p=cadastro&&del='+ id;
            }else{
            alert('ufaaa, quase deletou o contato errado.');
            }    
    }

    function atualizar(id) {
        var editar = confirm('Você deseja atualizar este contato?');
        if (editar){
            var width =450;
            var height = 550;

            var left = 99;
            var top = 99;
            //location.href = '?p=cadastro&&editar='+ id;
            window.open('http://localhost/PGA/editacadastro.php?edit='+ id,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

       }else{
            alert('ufaaa, quase editou o contato errado.');
            }    
    }

</script>
<?php
//Função para deletar o elemento
if(isset($_GET['del'])){
    $consulta->cod_cadastro=$_GET['del'];
    $consulta->deletar();
    echo ("<meta http-equiv='refresh' content='0; url=?p=cadastro'>");
}

//Função para inserir valor no banco
if(isset($_GET["p"])){  

    $con = $consulta;
    try{
        $dados = new mCadastro();
        
        if(filter_input(INPUT_POST, 'usuario')!=''){
            $dados->usuario=filter_input(INPUT_POST, 'usuario');
            $dados->email=filter_input(INPUT_POST, 'email');
            $dados->senha=filter_input(INPUT_POST, 'senha');
            $cadastra = $dados->inserir();

            if($cadastra){
                echo 'Comentário enviado.';
            }else{
                echo 'Fail!';
            }
       }
       else{           
                echo 'Nome não pode ser vazio.';
       }
    }catch (PDOexcpetion $erro){
        echo 'Erro : '.$erro->getMessage();	
    }    
    //echo ("<meta http-equiv='refresh' content='0; url=?p=cadastro'>");
}
?>
 
 
 