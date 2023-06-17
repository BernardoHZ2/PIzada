<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background-color: #001bc2;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
        }
        input{
            height: 20px;
            width: 300px;
            padding: 10px;
            border-radius: 10px;
            border: none;
            outline: none;
            margin: 10x;
            margin-bottom: 10px;
        }
        .box-card{
            border-radius: 15px;
            width: 500px;
            height: 400px;
            background-color: #000;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            position: relative;
        }
        .box-card > form{
            display: inline-block;
            position: relative;
            margin-left: 95px;
        }
        .box-card > input{
            display: inline-block;
            
        }
        .bgl{
            border-radius: 10px;
            border: none;
            outline: none;
            margin-bottom: 10px;
        }
        .botao{
            height: 10px;
            padding: 20px;
            top: 50%;
        }

    </style>
</head>
<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }
    ?>
    <div class="box-card">
    <form action="cadastro.php" method="post">
        <input type="text" class="bgl"  name="nome" placeholder="Name"/></br>
        <input type="text" name="apelido" placeholder="User"/></br>
        <input type="password" name="senha" placeholder="Password"/></br>
        <select name="tipoUsuario" class="bgl">Tipo Usuário
            <option value ="">Tipo Usuário</option>
            <option value ="1">Administrador</option>
            <option value ="2">Usuário</option>
        </select></br>
        <input type="submit" name="cadastro" class="botao" value="Cadastrar"/></br>
    </form>
</div>
    <?php
    include 'conn.php';
    if(isset($_POST['cadastro'])){
        $nome=$_POST['nome'];
        $apelido=$_POST['apelido'];
        $senha=$_POST['senha'];
        $tipoUsuario=$_POST['tipoUsuario'];
        if($nome != NULL && $apelido != NULL && $senha != NULL && $tipoUsuario != NULL ){
            $cadastrar=$conn->prepare('INSERT INTO `cadastro` (`id_cad`, `nome_cad`, `user_cad`, `senha_cad`, `adm_cad`) VALUES (NULL, :pnome, :papelido, md5(:psenha), :ptipoUsuario)');
            $cadastrar->bindValue(':pnome',$nome);
            $cadastrar->bindValue(':papelido',$apelido);
            $cadastrar->bindValue(':psenha',$senha);
            $cadastrar->bindValue(':ptipoUsuario',$tipoUsuario);
            $cadastrar->execute();
            echo "Cadastrado!";
        }
        else{
            echo "Preencha todos os campos!";
        }
    }
    echo "<a href='Index.php'><b><i>VOLTAR</i></b></a>"
?>