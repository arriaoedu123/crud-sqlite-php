<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = new SQLite3("usuario.db");

    $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :username");
    $stmt->bindValue(":username", $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: crud/crud.php");
        exit();
    } else {
        echo '<script>alert("Usuário ou senha incorretos!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <title>Login</title>
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="index.css" rel="stylesheet" />
</head>
<body>
  <div
    class="d-flex container-fluid flex-column align-items-center justify-content-center p-3 mt-3 gap-3 form-container">
    <form method="post" class="d-flex flex-column bg-body-tertiary rounded shadow-lg gap-3 p-3 p-md-5 form">
      <span class="h1 text-center">LOGIN</span>
      <div class="col-12 form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" required>
        <label for="username">Usuário</label>
      </div>
      <div class="col-12 form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
        <label for="password">Senha</label>
      </div>
      <div class="col-12 text-center py-3">
        Não possui conta? <a class="text-decoration-none" href="register.php">Registre-se</a>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100">ENTRAR</button>
      </div>
    </form>
  </div>
</body>
</html>