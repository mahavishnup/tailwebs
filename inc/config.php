<?php
ob_start();

try {
    $con = new PDO("mysql:dbname=tailwebs;host=localhost", "root", "password");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>