<?php
function getUsers() {
    $db = connectDB();
    $query = "SELECT * FROM alunos";
    $result = $db->query($query);
    $users = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $users[] = $row;
    }
    $db->close();
    return $users;
}
?>