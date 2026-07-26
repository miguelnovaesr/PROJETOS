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

$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

header("Location: listar.php");

exit();

?>