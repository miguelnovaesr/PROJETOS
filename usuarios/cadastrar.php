<?php

require_once "../includes/auth.php";
require_once "../config/conexao.php";

if ($_SESSION["tipo"] != "admin") {
    header("Location: ../index.php");
    exit();
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $tipo = $_POST["tipo"];

    $sql = "INSERT INTO usuarios(nome,email,senha,tipo)
            VALUES(?,?,?,?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome,$email,$senha,$tipo])) {

        $mensagem = "Usuário cadastrado com sucesso!";

    } else {

        $mensagem = "Erro ao cadastrar.";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Cadastrar Usuário</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header">

<h3>Cadastrar Usuário</h3>

</div>

<div class="card-body">

<?php if($mensagem != ""){ ?>

<div class="alert alert-success">

<?php echo $mensagem; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Nome</label>

<input
type="text"
name="nome"
class="form-control"
required>

</div>

<div class="mb-3">

<label>E-mail</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Senha</label>

<input
type="password"
name="senha"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tipo</label>

<select
name="tipo"
class="form-control">

<option value="comum">Usuário Comum</option>

<option value="admin">Administrador</option>

</select>

</div>

<button
class="btn btn-success">

Cadastrar

</button>

<a
href="../index.php"
class="btn btn-secondary">

Voltar

</a>

</form>

</div>

</div>

</div>

</body>

</html>