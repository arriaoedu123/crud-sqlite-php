<?php
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: ../index.php");
  exit();
}

$username = $_SESSION["username"];

include "connectDB.php";
include "read.php";
$users = getUsers();
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <title>CRUD - SQLite && PHP</title>
  <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="crud.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <nav class="navbar pt-3">
    <div class="container-xxl justify-content-start">
      <a class="me-md-3 me-xxl-0 icon" href="./welcome.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Voltar"><img src="../images/arrow-left-square.svg" /></a>
    </div>
  </nav>
  <div class="d-flex flex-column align-items-center gap-5 mt-3">
    <span class="h1 text-center">ALUNOS CADASTRADOS</span>
    <?php if (empty($users)) : ?>
    <span class="h5 text-center text-info">Não há alunos cadastrados até o momento.</span>
    <a class="btn btn-outline-info" href="./crudOne.php">CADASTRAR</a>
    <?php endif; ?>
  </div>
  <?php if (!empty($users)) : ?>
      <div class="table-responsive p-3 bg-body-tertiary mt-3">
        <table class="table table-striped">
          <tr>
            <th>RA</th>
            <th>NOME</th>
            <th>CURSO</th>
            <th>TELEFONE</th>
            <th>ENDEREÇO</th>
            <th>CIDADE</th>
            <th>ESTADO</th>
            <th></th>
          </tr>
          <?php foreach ($users as $user) : ?>
            <tr>
              <td class="fw-bold"><?= $user["id"] ?></td>
              <td><?= $user["nome"] ?></td>
              <td><?= $user["curso"] ?></td>
              <td><?= $user["telefone"] ?></td>
              <td><?= $user["endereco"] ?></td>
              <td><?= $user["cidade"] ?></td>
              <td><?= $user["estado"] ?></td>
              <td class="d-flex justify-content-center gap-3"><a class="btn btn-secondary btn-sm" href="crudOne.php?edit=<?= $user["id"] ?>">EDITAR</a><button type="button" class="btn btn-outline-danger btn-sm" onclick="if(confirm('Deseja excluir esse aluno?') == true) { window.location.href = 'crudOne.php?delete=<?= $user["id"] ?>' } else { return false }">DELETAR</button></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
  <?php endif; ?>

  <script src="../bootstrap/bootstrap.bundle.min.js"></script>
  <script src="crud.js"></script>
</body>

</html>