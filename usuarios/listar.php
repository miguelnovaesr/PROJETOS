<?php

require_once "../includes/auth.php";
require_once "../config/conexao.php";

if ($_SESSION["tipo"] != "admin") {
    header("Location: ../index.php");
    exit();
}

$sql = "SELECT * FROM usuarios ORDER BY nome ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Lista de Usuários</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header d-flex justify-content-between">

<h3>Usuários Cadastrados</h3>

<a href="cadastrar.php" class="btn btn-success">
Novo Usuário
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>

<th>Nome</th>

<th>E-mail</th>

<th>Tipo</th>

<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($usuarios as $usuario){ ?>

<tr>

<td><?php echo $usuario["id"]; ?></td>

<td><?php echo $usuario["nome"]; ?></td>

<td><?php echo $usuario["email"]; ?></td>

<td><?php echo ucfirst($usuario["tipo"]); ?></td>

<td>

<a
href="editar.php?id=<?php echo $usuario['id']; ?>"
class="btn btn-warning btn-sm">

Editar

</a>

<a
href="excluir.php?id=<?php echo $usuario['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Deseja realmente excluir este usuário?')">

Excluir

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="../index.php" class="btn btn-secondary">

Voltar

</a>

</div>

</div>

</div>

</body>

</html>