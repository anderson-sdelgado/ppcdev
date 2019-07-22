<?php

require('./dao/ApontPerdaDAO.class.php');

$apontPerdaDAO = new ApontPerdaDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

//    $dados = '{"cabecalho":[{"auditor1":110758,"auditor2":112188,"auditor3":0,"colhedora":715,"data":"10/4/2017","dhEnvio":"10/4/2017 14:6","frente":2,"id":1,"operador":11415,"os":56,"secao":2,"status":2,"talhao":1,"tipo":1,"turno":2}]}_{"amostra":[{"canaInteira":5.0,"id":1,"idCabecalho":1,"lascas":9.0,"num":1,"obsv":". FORMIGUEIROS .. PEDRA .","pedaco":4.0,"ponteiro":5.0,"repique":0.0,"soqueiraKg":6.0,"soqueiraNum":5.0,"tara":2.0,"toco":3.0,"tolete":6.0}]}';
    
    $dados = $info['dado'];
    $posicao = strpos($dados, "_") + 1;
    $cabec = substr($dados, 0, ($posicao - 1));
    $item = substr($dados, $posicao);

    $jsonObjCabec = json_decode($cabec);
    $jsonObjItem = json_decode($item);
    $dadosCab = $jsonObjCabec->cabecalho;
    $dadosItem = $jsonObjItem->amostra;
    
    $retorno = $apontPerdaDAO->salvarDados($dadosCab, $dadosItem);

endif;

echo 'GRAVOU-ANALISE';
