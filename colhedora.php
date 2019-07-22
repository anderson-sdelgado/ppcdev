<?php

require('./dao/ColhedoraDAO.class.php');

$colhedoraDAO = new ColhedoraDAO();

//cria o array associativo
$dados = array("dados"=>$colhedoraDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
