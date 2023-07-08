<?php

include("./db.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$objDb = new DbConnect;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
        case "GET":
            $sql = "SELECT sum(valor) as valor FROM store WHERE DATE(dateLaunch) = CURDATE()";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            echo json_encode($users);
        
            break;
}

?>