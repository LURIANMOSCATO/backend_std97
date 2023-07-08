<?php

include("./db.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$objDb = new DbConnect;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {

    case "GET":
    $sql = "SELECT id, upper(barbeiro) as barbeiro, upper(description) as description, valor, DATE_FORMAT(dateLaunch, '%d/%m/%Y') as dateLaunch FROM store ORDER BY day(dateLaunch), month(dateLaunch) DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);

    break;

    case "POST":

        $user = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO store (barbeiro, description, valor) VALUES (:barbeiro, :description, :valor)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':barbeiro', $user->barbeiro);
        $stmt->bindParam(':description', $user->description);
        $stmt->bindParam(':valor', $user->valor);

        if($stmt->execute()){
            $response = ['status' => 1, 'message' => 'Lançamento Realizado!'];
        } else {
            $response = ['status' => 0, 'message' => 'Lançamento de Produto Falhou!'];
        }

        echo json_encode($response);
        break;
    
}
?>