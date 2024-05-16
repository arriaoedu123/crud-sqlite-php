<?php
function updateUser($data)
{
    $db = connectDB();
    $query = "UPDATE alunos SET nome=:nome, email=:email, telefone=:telefone, endereco=:endereco, cidade=:cidade, estado=:estado WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $data['id'], SQLITE3_INTEGER);
    $stmt->bindValue(':nome', $data['nome'], SQLITE3_TEXT);
    $stmt->bindValue(':email', $data['email'], SQLITE3_TEXT);
    $stmt->bindValue(':telefone', $data['telefone'], SQLITE3_TEXT);
    $stmt->bindValue(':endereco', $data['endereco'], SQLITE3_TEXT);
    $stmt->bindValue(':cidade', $data['cidade'], SQLITE3_TEXT);
    $stmt->bindValue(':estado', $data['estado'], SQLITE3_TEXT);
    $stmt->execute();
    $db->close();
}
