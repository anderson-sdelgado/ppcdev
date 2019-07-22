<?php

require('./dao/ObservacaoDAO.class.php');

$observacaoDAO = new ObservacaoDAO();

//cria o array associativo
$dados = array("dados"=>$observacaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;