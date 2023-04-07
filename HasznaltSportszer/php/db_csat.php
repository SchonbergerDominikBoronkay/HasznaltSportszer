<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportszer_ab";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Sikertelen kapcsolódás: " . $e->getMessage();
}

?>