<?php

$headers = getallheaders();
header('Content-type: application/json');
$body = file_get_contents('php://input');

$token = '';
if (!array_key_exists('Authorization', $headers) && !array_key_exists('authorization', $headers)) {
    echo json_encode(["error" => "Authorization header is missing"]);
    exit;
}

if (array_key_exists('Authorization', $headers)) {
    $token = $headers['Authorization'];
}

if (array_key_exists('authorization', $headers)) {
    $token = $headers['authorization'];
}

require_once('../control/AtualAplicCTR.class.php');

$atualAplicCTR = new AtualAplicCTR();
if (!$atualAplicCTR->verToken($token)) {
    echo json_encode(["error" => "Invalid token"]);
    exit;
}

if (!isset($body)) {
    echo json_encode(["error" => "Empty body"]);
    exit;
}

require_once('../control/BaseDadosCTR.class.php');

$baseDadosCTR = new BaseDadosCTR();
echo $baseDadosCTR->dadosOS($body);
