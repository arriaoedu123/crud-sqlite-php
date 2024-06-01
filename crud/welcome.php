<?php
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: ../index.php");
  exit();
}

$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <title>Tela inicial</title>
  <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="./crud.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav class="navbar pt-3">
    <div class="container-xxl justify-content-end gap-4">
      <a href="https://github.com/arriaoedu123/crud-sqlite-php" target="_blank" class="icon"><img src="../images/github.svg" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="GitHub" /></a>
      <a class="me-md-3 me-xxl-0 icon" href="logout.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Sair"><img src="../images/box-arrow-left.svg" /></a>
    </div>
  </nav>
  <div class="d-flex container-fluid flex-column align-items-center justify-content-center p-3 gap-3 welcome-container">
    <div class="d-flex flex-column bg-body-tertiary rounded gap-3 p-3 p-md-5 welcome">
      <span class="h1 text-center text-uppercase">BEM-VINDO, <?= $username ?>!</span>
      <span class="h5 text-center">SELECIONE UMA DAS OPÇÕES ABAIXO</span>
      <div class="d-flex flex-column gap-3 mt-3">
        <a type="button" class="btn btn-primary btn-lg" href="./crudOne.php">CADASTRAR ALUNO</a>
        <a type="button" class="btn btn-primary btn-lg" href="./crudTwo.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Aqui também é possível selecionar as opções EDITAR e DELETAR">VISUALIZAR ALUNOS</a>
      </div>
    </div>
  </div>

  <script src="../bootstrap/bootstrap.bundle.min.js"></script>
  <script src="crud.js"></script>
</body>
</html>