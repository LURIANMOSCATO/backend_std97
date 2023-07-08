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
    
    $sql = "SELECT idCliente, upper(nomeCliente) AS nomeCliente, upper(servicoCliente) as servicoCliente, upper(barbeiro) as barbeiro, telefoneCliente, valor, hora, tempo, DATE_FORMAT(datas, '%d/%m/%Y') AS datas FROM services ORDER BY month(datas), day(datas), time(hora) ";
    $path = explode('/', $_SERVER['REQUEST_URI']);
    if(isset($path[3]) && is_numeric($path[3])) {
    $sql .= "WHERE id = :idCliente";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idCliente', $path[3]);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    echo json_encode($users);

    break;

    case "POST":

        $user = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO services (nomeCliente, telefoneCliente, barbeiro, servicoCliente, datas, hora, tempo, valor) VALUES (:name, :telefone, :barbeiro, :servico, :datas, :hora, :tempo, :valor)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':telefone', $user->telefone);
        $stmt->bindParam(':barbeiro', $user->barbeiro);
        $stmt->bindParam(':servico', $user->servico);
        $stmt->bindParam(':datas', $user->datas);
        $stmt->bindParam(':hora', $user->hora);
        $stmt->bindParam(':tempo', $user->tempo);
        $stmt->bindParam(':valor', $user->valor);

        if($stmt->execute()){
            $response = ['status' => 1, 'message' => 'Agendado'];
        } else {
            $response = ['status' => 0, 'message' => 'não Agendado'];
        }

        echo json_encode($response);
        break;
    
}
?>