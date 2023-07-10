<?php
include("./db.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST");

$conexao = new mysqli(SERVER,USER,PASSWORD,DATABASE);
if(mysqli_connect_error()){
    echo mysqli_connect_error();
    exit();
    }
    else{
        $eData = file_get_contents("php://input");
        $dData = json_decode($eData, true);

        $user = $dData['user'];
        $pass = $dData['pass'];
        $result = "";

        if($user != "" and $pass != ""){
            $sql = "SELECT * FROM login WHERE user='$user';";
            $res = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_array($res);
                if($pass != $row['pass']){
                    $result = "Invalid password!";
                }
                else{
                    $result = "Logado! Aguarde...";
                }
            }
            else{
                $result = "Invalid username!";
            }
        }
        else{
            $result = "";
        }

        $conexao -> close();
        $response[] = array("result" => $result);
        echo json_encode($response);
    }



?>
