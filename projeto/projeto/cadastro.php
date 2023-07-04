<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-color: #00BFFF;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 400px;
      padding: 30px;
      border-radius: 10px;
      background-color: lightgray;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    form {
      margin-top: 30px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    select {
      height: 40px;
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
    }

    .button-container button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #00FF00;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    .button-container button:hover {
      background-color: #009900;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #333;
      font-size: 14px;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['login'])) {
    header('location: login.php');
  }
  ?>
  <div class="container">
    <h1>Cadastro de Usuário</h1>
    <form action="cadastro.php" method="post">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>

      <label for="apelido">Usuário:</label>
      <input type="text" name="apelido" id="apelido" placeholder="Digite seu usuário" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>

      <label for="tipoUsuario">Tipo de Usuário:</label>
      <select name="tipoUsuario" id="tipoUsuario" required>
        <option value="">Selecione o tipo de usuário</option>
        <option value="1">Administrador</option>
        <option value="2">Comum</option>
      </select>

      <div class="button-container">
        <button type="submit" name="cadastro">Cadastrar</button>
      </div>
    </form>

    <a href="Index.php" class="back-link">Voltar</a>
  </div>

  <?php
  include 'conn.php';
  if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
    $tipoUsuario = $_POST['tipoUsuario'];
    if ($nome != NULL && $apelido != NULL && $senha != NULL && $tipoUsuario != NULL) {
      $cadastrar = $conn->prepare('INSERT INTO `cadastro` (`id_cad`, `nome_cad`, `user_cad`, `senha_cad`, `adm_cad`) VALUES (NULL, :pnome, :papelido, md5(:psenha), :ptipoUsuario)');
      $cadastrar->bindValue(':pnome', $nome);
      $cadastrar->bindValue(':papelido', $apelido);
      $cadastrar->bindValue(':psenha', $senha);
      $cadastrar->bindValue(':ptipoUsuario', $tipoUsuario);
      $cadastrar->execute();
      echo "<p>Cadastrado!</p>";
    } else {
      echo "<p>Preencha todos os campos!</p>";
    }
  }
  ?>
</body>

</html>