<?php
function connectDB() {
    return new SQLite3('aluno.db');
}
?>