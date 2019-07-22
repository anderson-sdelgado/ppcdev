<?php

require('./dao/TipoAmostradorDAO.class.php');

$tipoAmostradorDAO = new TipoAmostradorDAO();

//cria o array associativo
$dados = array("dados"=>$tipoAmostradorDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
