<?php
global $pdo;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tasklist', 'root', '');
}

catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}

?>