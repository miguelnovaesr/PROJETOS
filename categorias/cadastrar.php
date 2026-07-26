<?php

require_once "../includes/auth.php";
require_once "../config/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];

    $sql = "INSERT INTO categorias(nome) VALUES(?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome])) {

        $mensagem = "Categoria cadastrada com sucesso!";

    } else {

        $mensagem = "Erro ao cadastrar categoria.";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Cadastrar Categoria</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header">

<h3>Cadastrar Categoria</h3>

</div>

<div class="card-body">

<?php if($mensagem != ""){ ?>

<div class="alert alert-success">

<?php echo $mensagem; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Nome da Categoria</label>

<input
type="text"
name="nome"
class="form-control"
required>

</div>

<button class="btn btn-success">

Cadastrar

</button>

<a href="listar.php" class="btn btn-secondary">

Voltar

</a>

</form>

</div>

</div>

</div>

</body>

</html>