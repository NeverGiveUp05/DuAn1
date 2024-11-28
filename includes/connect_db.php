<?php
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "tacong09032005";
    $dbname = "duanmau";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
