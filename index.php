<?php

require_once "includes/auth.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Task Manager</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="index.php">
Task Manager
</a>

<div>

<span class="text-white me-3">
Olá,
<?php echo $_SESSION["nome"]; ?>
</span>

<a href="logout.php" class="btn btn-danger">
Sair
</a>

</div>

</div>

</nav>

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2>Bem-vindo ao Sistema de Gestão de Tarefas</h2>

<p>Login realizado com sucesso.</p>

<p>Utilize o menu para acessar as funcionalidades do sistema.</p>

<hr>

<?php

if($_SESSION["tipo"] == "admin"){

?>

<div class="alert alert-primary">

Você está logado como <strong>Administrador</strong>.

</div>

<?php

}else{

?>

<div class="alert alert-success">

Você está logado como <strong>Usuário Comum</strong>.

</div>

<?php

}

?>

</div>

</div>

</div>

</body>

</html>