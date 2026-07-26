<?php

require_once "../includes/auth.php";
require_once "../config/conexao.php";

if ($_SESSION["tipo"] != "admin") {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: listar.php");
    exit();
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tipo = $_POST["tipo"];

    $sql = "UPDATE usuarios
            SET nome = ?, email = ?, tipo = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome, $email, $tipo, $id])) {

        $mensagem = "Usuário atualizado com sucesso.";

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    } else {

        $mensagem = "Erro ao atualizar.";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Editar Usuário</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header">

<h3>Editar Usuário</h3>

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
value="<?php echo $usuario['nome']; ?>"
required>

</div>

<div class="mb-3">

<label>E-mail</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $usuario['email']; ?>"
required>

</div>

<div class="mb-3">

<label>Tipo</label>

<select name="tipo" class="form-control">

<option value="comum" <?php if($usuario["tipo"]=="comum") echo "selected"; ?>>
Usuário Comum
</option>

<option value="admin" <?php if($usuario["tipo"]=="admin") echo "selected"; ?>>
Administrador
</option>

</select>

</div>

<button class="btn btn-primary">

Salvar Alterações

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