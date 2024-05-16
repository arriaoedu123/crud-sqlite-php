<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION["username"];

include "connectDB.php";
include "read.php";
$users = getUsers();

$estados = [
    "AC" => "Acre",
    "AL" => "Alagoas",
    "AP" => "Amapá",
    "AM" => "Amazonas",
    "BA" => "Bahia",
    "CE" => "Ceará",
    "DF" => "Distrito Federal",
    "ES" => "Espírito Santo",
    "GO" => "Goiás",
    "MA" => "Maranhão",
    "MT" => "Mato Grosso",
    "MS" => "Mato Grosso do Sul",
    "MG" => "Minas Gerais",
    "PA" => "Pará",
    "PB" => "Paraíba",
    "PR" => "Paraná",
    "PE" => "Pernambuco",
    "PI" => "Piauí",
    "RJ" => "Rio de Janeiro",
    "RN" => "Rio Grande do Norte",
    "RS" => "Rio Grande do Sul",
    "RO" => "Rondônia",
    "RR" => "Roraima",
    "SC" => "Santa Catarina",
    "SP" => "São Paulo",
    "SE" => "Sergipe",
    "TO" => "Tocantins",
];

if (isset($_GET["edit"])) {
    $edit_id = $_GET["edit"];
    $user = array_filter($users, function ($u) use ($edit_id) {
        return $u["id"] == $edit_id;
    });
    $user = reset($user);
} else {
    $user = [
        "id" => "",
        "nome" => "",
        "email" => "",
        "telefone" => "",
        "endereco" => "",
        "cidade" => "",
        "estado" => "",
    ];
}

if (isset($_GET["delete"])) {
    include "delete.php";
    $delete_id = $_GET["delete"];
    deleteUser($delete_id);
    header("Location: crud.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "create.php";
    include "update.php";
    if ($_POST["id"] == "") {
        createUser($_POST);
    } else {
        updateUser($_POST);
    }
    header("Location: crud.php");
    exit();
}
?>
    
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>CRUD - SQLite && PHP</title>
  <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="crud.css" rel="stylesheet" />
</head>
<body>
  <nav class="navbar pt-3">
    <div class="container-xxl justify-content-end gap-4">
        <a href="https://github.com/arriaoedu123/crud-sqlite-php" target="_blank" class="icon"><img src="../images/github.svg"
            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="GitHub" /></a>
        <a class="me-md-3 me-xxl-0 icon" href="logout.php" data-bs-toggle="tooltip" data-bs-placement="bottom"
          data-bs-title="Sair"><img src="../images/box-arrow-left.svg" /></a>
    </div>
  </nav>
  <div class="d-flex flex-column container-fluid align-items-center p-3 mt-3">
    <form method="post" action="crud.php" class="container row g-3 bg-body-tertiary rounded p-3">
    <span class="h1 text-center mb-3">
        <?php if (isset($_GET["edit"])): ?>
            EDITAR ALUNO
        <?php else: ?>
            ADICIONAR ALUNO
        <?php endif; ?>
    </span>
      <?php if (isset($_GET["edit"])): ?>
      <div>
        <label for="id" class="form-label pe-none">RA</label>
        <input type="text" class="form-control text-center pe-none" id="id" name="id" value="<?= isset(
                            $user["id"]
                        )
                            ? $user["id"]
                            : "" ?>" readonly>
      </div>
      <?php else: ?>
      <input type="hidden" name="id" value="<?= isset($user["id"])
                        ? $user["id"]
                        : "" ?>">
      <?php endif; ?>
      <div class="col-12 col-md-5">
        <label for="nome" class="form-label">NOME</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Cláudio" value="<?= isset(
                        $user["nome"]
                    )
                        ? $user["nome"]
                        : "" ?>" required>

      </div>
      <div class="col-12 col-md-7">
        <label for="email" class="form-label">E-MAIL</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="claudio@exemplo.com" value="<?= isset(
                        $user["email"]
                    )
                        ? $user["email"]
                        : "" ?>" required>
      </div>
      <div class="col-12 col-md-4">
        <label for="telefone" class="form-label">TELEFONE</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(12) 34567-8901"
          oninput="formatarNumero()" value="<?= isset(
                        $user["telefone"]
                    )
                        ? $user["telefone"]
                        : "" ?>" required>
      </div>
      <div class="col-12 col-md-8">
        <label for="endereco" class="form-label">ENDEREÇO</label>
        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="João das Neves" value="<?= isset(
                        $user["endereco"]
                    )
                        ? $user["endereco"]
                        : "" ?>" required>
      </div>
      <div class="col-12 col-md-6">
        <label for="cidade" class="form-label">CIDADE</label>
        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Nevelândia" value="<?= isset(
                        $user["cidade"]
                    )
                        ? $user["cidade"]
                        : "" ?>" required>
      </div>
      <div class="col-12 col-md-6">
        <label for="estado" class="form-label">ESTADO</label>
        <select class="form-select" id="estado" name="estado" required>
          <option value="">Selecione o Estado</option>
          <?php foreach ($estados as $sigla => $estado): ?>
          <option value="<?= $sigla ?>" <?= isset($user["estado"]) && $user["estado"] == $sigla ? "selected" : "" ?>>
            <?= $estado ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-12 d-flex justify-content-end gap-3">
        <button class="btn btn-success" type="submit">
          <?php if (isset($_GET["edit"])): ?>
          CONFIRMAR
          <?php else: ?>
          ADICIONAR
          <?php endif; ?>
        </button>
        <?php if (isset($_GET["edit"])): ?>
        <a href="crud.php" class="btn btn-outline-danger">CANCELAR</a>
        <?php endif; ?>
      </div>
    </form>
  </div>
    <?php if (!empty($users)): ?>
    <div class="table-responsive p-3 bg-body-tertiary">
        <table class="table table-striped">
          <tr>
            <th>RA</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            <th>TELEFONE</th>
            <th>ENDEREÇO</th>
            <th>CIDADE</th>
            <th>ESTADO</th>
            <th>AÇÕES</th>
          </tr>
          <?php foreach ($users as $user): ?>
          <tr>
            <td class="fw-bold"><?= $user["id"] ?></td>
            <td><?= $user["nome"] ?></td>
            <td><?= $user["email"] ?></td>
            <td><?= $user["telefone"] ?></td>
            <td><?= $user["endereco"] ?></td>
            <td><?= $user["cidade"] ?></td>
            <td><?= $user["estado"] ?></td>
            <td class="d-flex justify-content-center gap-3"><a class="btn btn-secondary btn-sm" href="crud.php?edit=<?= $user[
                                "id"
                            ] ?>">EDITAR</a><button type="button" class="btn btn-outline-danger btn-sm" onclick="if(confirm('Deseja excluir esse aluno?') == true) { window.location.href = 'crud.php?delete=<?= $user[
        "id"
    ] ?>' } else { return false }">DELETAR</button></td>
          </tr>
          <?php endforeach; ?>
        </table>
    </div>
  <?php endif; ?>

  <script src="../bootstrap/bootstrap.bundle.min.js"></script>
  <script src="crud.js"></script>
</body>
</html>