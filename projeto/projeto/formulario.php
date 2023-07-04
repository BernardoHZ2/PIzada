<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, #00BFFF, #1E90FF);
        }

        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }

        fieldset {
            border: 3px solid dodgerblue;
        }

        legend {
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }

        .inputBox {
            position: relative;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus~.labelInput,
        .inputUser:valid~.labelInput {
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }

        #data_nascimento {
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }

        #submit {
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #submit:hover {
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>

<body>
    <div class="box">
        <form action="formulario.php" method="post">
            <fieldset>
                <legend><b>Fórmulário</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone para Contato</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="responsavel" id="responsavel" class="inputUser" required>
                    <label for="responsavel" class="labelInput">Telefone do Responsavel</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="genero" id="genero" class="inputUser" required>
                    <label for="genero" class="labelInput">Genero</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="nascimento" id="nascimento" class="inputUser" required>
                    <label for="nascimento" class="labelInput">Data de Nascimento</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelInput">Endereço</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="medicacao" id="medicacao" class="inputUser" required>
                    <label for="medicacao" class="labelInput">Possui alergia a alguma medicação?</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="doenca" id="doenca" class="inputUser" required>
                    <label for="doenca" class="labelInput">Possui alguma doença pré-existente?</label>
                </div>
                <br><br>
                <input type="submit" name="formulario" id="submit" value="Cadastrar"/></br>
            </fieldset>
        </form>
    </div>
</body>

</html>
<?php
    include 'conn.php';
    if(isset($_POST['formulario'])){
        $nome=$_POST['nome'];
        $telefone=$_POST['telefone'];
        $responsavel=$_POST['responsavel'];
        $genero=$_POST['genero'];
        $nascimento=$_POST['nascimento'];
        $endereco=$_POST['endereco'];
        $medicacao=$_POST['medicacao'];
        $doenca=$_POST['doenca'];
        if($nome != NULL && $telefone != NULL && $responsavel != NULL && $genero != NULL && $nascimento != NULL && $endereco != NULL && $medicacao != NULL && $doenca != NULL){
            $cadastrar=$conn->prepare('INSERT INTO `formulario` (`id_form`, `nome_form`, `contato_form`, `resp_form`, `genero_form`, `data_form`, `endereco_form`, `med_form`, `doenca_form`) VALUES (NULL, :pnome, :ptelefone, :presponsavel, :pgenero, :pnascimento, :pendereco, :pmedicacao, :pdoenca)');
            $cadastrar->bindValue(':pnome',$nome);
            $cadastrar->bindValue(':ptelefone',$telefone);
            $cadastrar->bindValue(':presponsavel',$responsavel);
            $cadastrar->bindValue(':pgenero',$genero);
            $cadastrar->bindValue(':pnascimento',$nascimento);
            $cadastrar->bindValue(':pendereco',$endereco);
            $cadastrar->bindValue(':pmedicacao',$medicacao);
            $cadastrar->bindValue(':pdoenca',$doenca);
            $cadastrar->execute();
            echo "Cadastrado!";
        }
        else{
            echo "Preencha todos os campos!";
        }
    }
    echo "<a href='Index.php'><b><i>VOLTAR</i></b></a>"
?>