<?php
function createUser($data)
{
    $db = connectDB();
    $query = "INSERT INTO alunos (nome, email, telefone, endereco, cidade, estado) 
              VALUES (:nome, :email, :telefone, :endereco, :cidade, :estado)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':nome', $data['nome'], SQLITE3_TEXT);
    $stmt->bindValue(':email', $data['email'], SQLITE3_TEXT);
    $stmt->bindValue(':telefone', $data['telefone'], SQLITE3_TEXT);
    $stmt->bindValue(':endereco', $data['endereco'], SQLITE3_TEXT);
    $stmt->bindValue(':cidade', $data['cidade'], SQLITE3_TEXT);
    $stmt->bindValue(':estado', $data['estado'], SQLITE3_TEXT);
    $stmt->execute();
    $db->close();
}
