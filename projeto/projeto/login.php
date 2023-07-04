<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, #00BFFF, #1E90FF);
        }
        div{
            background-color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }
        input{
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div>
        <form action="login.php" method="POST">
        <h1>Login</h1>
        <input type="text"name="user" placeholder="Nome">
        <br><br>
        <input type="password"name="senha" placeholder="Senha">
        <br><br>
        <input type="submit"name="login" value="Enviar">
        </form>
    </div>
</body>
</html>
<?php
include 'conn.php';
if(isset ($_POST['login'])){
    $user=$_POST['user'];
    $senha=$_POST['senha'];
    $login=$conn->prepare('SELECT * FROM `cadastro` WHERE `user_cad` =:puser AND `senha_cad` =md5 (:psenha) ;');
    $login->bindValue(':puser',$user);
    $login->bindValue(':psenha',$senha);
    $login->execute();
    if($login->rowCount()==0){
        echo"Login ou senha invalida!";
    }else{
        session_start();
        $row=$login->fetch();
        $_SESSION['login']=$row['id_cad'];
        header('location:index.php');
    }
}
?>