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
    $path = explode('/', $_SERVER['REQUEST_URI']);
    
    $sql = "SELECT idCliente, upper(nomeCliente) AS nomeCliente, upper(servicoCliente) as servicoCliente, upper(barbeiro) as barbeiro, telefoneCliente, valor, hora, tempo, DATE_FORMAT(datas, '%d/%m/%Y') AS datas FROM services ORDER BY month(datas), day(datas), time(hora) ";
    
    $result = mysqli_query($conn, $sql);

    $json_array = array();

    while($row = mysqli_fetch_array($result)) {
    $json_array[]=$row;
}

echo json_encode($json_array);

}
    



?>
