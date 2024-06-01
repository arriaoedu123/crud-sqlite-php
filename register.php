<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $db = new SQLite3("usuario.db");

  $stmt = $db->prepare(
    "SELECT COUNT(*) as count FROM usuarios WHERE username = :username"
  );
  $stmt->bindValue(":username", $username, SQLITE3_TEXT);
  $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

  if ($result["count"] > 0) {
    echo '<script>alert("Erro ao registrar usuário! Usuário já existe");</script>';
  } else {
    $stmt = $db->prepare(
      "INSERT INTO usuarios (username, password) VALUES (:username, :password)"
    );
    $stmt->bindValue(":username", $username, SQLITE3_TEXT);
    $stmt->bindValue(
      ":password",
      password_hash($password, PASSWORD_DEFAULT),
      SQLITE3_TEXT
    );

    if ($stmt->execute()) {
      header("Location: index.php");
      exit();
    } else {
      echo '<script>alert("Erro ao registrar usuário!");</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <title>Cadastro</title>
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="index.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="d-flex container-fluid flex-column align-items-center justify-content-center p-3 mt-3 gap-3 form-container">
    <form method="post" class="d-flex flex-column bg-body-tertiary rounded gap-3 p-3 p-md-5 form">
      <span class="h1 text-center">CADASTRO</span>
      <div class="col-12 form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" required>
        <label for="username">Usuário</label>
      </div>
      <div class="col-12 form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
        <label for="password">Senha</label>
      </div>
      <div class="col-12 text-center py-3">
        Já possui conta? <a class="text-decoration-none" href="index.php">Entrar</a>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100">CADASTRAR</button>
      </div>
    </form>
  </div>
</body>
</html>