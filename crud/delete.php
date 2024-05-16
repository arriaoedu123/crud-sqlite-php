<?php
function deleteUser($id)
{
    $db = connectDB();
    $query = "DELETE FROM alunos WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    $db->close();
}
