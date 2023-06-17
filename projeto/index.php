<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background-color: #B0E0E6;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
        }
    </style>
</head>
<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location:login.php');
}
    include 'conn.php';
    $id=$_SESSION['login'];
    $nome=$conn->prepare('SELECT * FROM cadastro WHERE id_cad=:pid;');
    $nome->bindValue(':pid',$id);
    $nome->execute();
    $rownome=$nome->fetch();
    echo "Bem vindo, ".$rownome['nome_cad']."!";
    echo "<hr>";
    $mostra=$conn->prepare('SELECT * FROM arquivos');
    $mostra->execute();

    if($mostra->rowCount()==0){
        echo "Não há registros!</br>";
    }
    else{
            ?>
            <table border="1">
            <tr>
            <th>Nome Arquivo</th>
            <th></th>
            </tr>
            <?php
            while($row=$mostra->fetch()){
                echo "<tr>";
                echo "<td>".$row['nome_arq']."</td>";
                echo "<td><a href ='index.php?avisoExcluir&id=".base64_encode($row['id_arq'])."&nome=".base64_encode($row['nome_arq'])."'>Excluir</a></td>";
                echo "</tr>";
            }
            ?>
            </table>
            <?php   
    }   
    if(isset($_GET['excluir'])){
        $id=base64_decode($_GET['id']);
        $nome=base64_decode($_GET['nome']);
        $excluir=$conn->prepare('DELETE FROM arquivos WHERE `arquivos`.`id_arq` = :pid;');
        $excluir->bindValue(':pid',$id);
        $excluir->execute();
        echo "</br>".$nome.", excluído com sucesso!";
        echo "</br></br><a href='index.php'> Voltar </a>";
        exit();
    }
    if(isset($_GET['avisoExcluir'])){
        $id=$_GET['id'];
        $nome=base64_decode($_GET['nome']);
        echo "</br>Deseja realmente excluir $nome?</br>";
        echo "<a href='index.php?excluir&id=$id&nome=".base64_encode($nome)."'>Sim</a><a href='index.php'>Não</a></br>";
    }
    echo "</br><a href='index.php?inserir'> Inserir Arquivos </a>";
    if(isset($_GET['inserir'])){
        ?>
        </br></br>
        <form action ="" method="post" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome do Arquivo"/></br></br>
            <input type="file" name="arquivo"/></br></br>
            <input type="submit" name="gravar" value="Gravar"/>
        </form>
        <?php
        if(isset($_POST['gravar'])){
            $nome=$_POST['nome'];
            $_UP['pasta']="arquivos/";
            $_UP['tamanho']=1024*1024*2;
            $_UP['extensao']=array('pdf');
            $_UP['renomear']=true;

            $explode=explode('.', $_FILES['arquivo']['name']);
            $aponta=end($explode);
            $extensao=strtolower($aponta);

            if(array_search($extensao, $_UP['extensao'])===false){
                echo "Extensão não aceita.";
                echo "</br></br><a href='index.php?inserir'> Voltar </a>";
                exit();
            }
            if($_UP['tamanho']<= $_FILES['arquivo']['size']){
                echo "O arquivo ultrapasso o tamanho permitido.";
                echo "</br></br><a href='index.php?inserir'> Voltar </a>";
                exit();
            }
            if($_UP['renomear']===true){
                $nome_final=md5(time()).".$extensao";
            }
            else{
                $nome_final=$_FILES['arquivo']['name'];
            }
            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)){   
                include 'conn.php';
                $url=$_UP['pasta'].$nome_final;
                $grava=$conn->prepare('INSERT INTO arquivos (id_arq, nome_arq, url_arq) VALUES (NULL, :pnome, :purl);');
                $grava->bindvalue(':pnome', $nome);
                $grava->bindvalue(':purl', $url);
                $grava->execute();
                echo "Gravado com sucesso!";
                echo "</br></br><a href='index.php?inserir'> Voltar </a>";
                exit();
            }
            else{
                echo "Ops! Algo deu errado.</br>";
            }
        }
        echo "<a href='index.php'> Sair </a>";
    }
    if($rownome['adm_cad'] == 1){
        echo "</br></br> <a href='cadastro.php'> Cadastrar Novo Usuário </a>";
    }
    echo "</br></br> <a href='index.php?avisoLogout'>Logout</a>";
    if(isset($_GET['avisoLogout'])){
        echo "</br></br>Deseja realmente sair?</br>";
        echo "<a href='index.php?logout'>Sim </a>";
        echo "<a href='index.php'>Não</a>";
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header('location:login.php');
    }
?>