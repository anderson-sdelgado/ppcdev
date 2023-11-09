<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/CabecPerdaDAO.class.php');
require_once('../model/AmostraPerdaDAO.class.php');
/**
 * Description of PerdaCTR
 *
 * @author anderson
 */
class PerdaCTR {
    //put your code here
    
    public function salvarDados($info) {

        $dados = $info['dado'];

        $pos1 = strpos($dados, "_") + 1;

        $cabec = substr($dados, 0, ($pos1 - 1));
        $amostra = substr($dados, $pos1);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjAmostra = json_decode($amostra);

        $dadosCabec = $jsonObjCabec->cabec;
        $dadosAmostra = $jsonObjAmostra->amostra;

        $ret = $this->salvarCabec($dadosCabec, $dadosAmostra);
        return $ret;
    }

    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    private function salvarCabec($dadosCabec, $dadosAmostra) {
        $cabecPerdaDAO = new CabecPerdaDAO();
        $idCabecArray = array();
        foreach ($dadosCabec as $cabec) {
            if ($cabec->tipoColheitaCabec == 1) {
                $cabec->tipoColheitaCabec = 5;
            } else {
                $cabec->tipoColheitaCabec = 6;
            }
            $v = $cabecPerdaDAO->verifCabec($cabec);
            if ($v == 0) {
                $idCabec = $cabecPerdaDAO->insCabec($cabec);
                $this->salvarAmostra($idCabec, $cabec->idCabec, $dadosAmostra);
            }
            $idCabecArray[] = array("idCabec" => $cabec->idCabec);
        }
        $dadoCabec = array("cabec"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return 'GRAVOU-ANALISE_' . $retCabec;
    }

    private function salvarAmostra($idCabecBD, $idCabecCel, $dadosAmostra) {
        $amostraPerdaDAO = new AmostraPerdaDAO();
        foreach ($dadosAmostra as $amostra) {
            if ($idCabecCel == $amostra->idCabecAmostra) {
                $v = $amostraPerdaDAO->verifAmostra($idCabecBD, $amostra);
                if ($v == 0) {
                    $amostraPerdaDAO->insAmostra($idCabecBD, $amostra);
                }
            }
        }
    }
    
}
