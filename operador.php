<?php

require('./dao/OperadorDAO.class.php');

$operadorDAO = new OperadorDAO();

//cria o array associativo
$dados = array("dados"=>$operadorDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
