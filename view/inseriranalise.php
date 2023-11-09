<?php

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/PerdaCTR.class.php');

if (isset($info)):

    $perdaCTR = new PerdaCTR();
    echo $perdaCTR->salvarDados($info);
    
endif;
