<?php
function createUser($data)
{
    $db = connectDB();
    $query = "INSERT INTO alunos (nome, curso, telefone, endereco, cidade, estado) 
              VALUES (:nome, :curso, :telefone, :endereco, :cidade, :estado)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':nome', $data['nome'], SQLITE3_TEXT);
    $stmt->bindValue(':curso', $data['curso'], SQLITE3_TEXT);
    $stmt->bindValue(':telefone', $data['telefone'], SQLITE3_TEXT);
    $stmt->bindValue(':endereco', $data['endereco'], SQLITE3_TEXT);
    $stmt->bindValue(':cidade', $data['cidade'], SQLITE3_TEXT);
    $stmt->bindValue(':estado', $data['estado'], SQLITE3_TEXT);
    $stmt->execute();
    $db->close();
}
