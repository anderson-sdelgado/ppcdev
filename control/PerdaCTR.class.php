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
class PerdaCTR
{

    public function salvarDados($body)
    {
        $cabecArray = json_decode($body);
        return $this->salvarCabec($cabecArray);
    }

    private function salvarCabec($cabecArray)
    {
        $cabecDAO = new CabecPerdaDAO();
        $ret = array();
        foreach ($cabecArray as $cab) {
            $v = $cabecDAO->verifCabec($cab);
            if ($v <= 0) {
                $cabecDAO->insCabec($cab);
            }
            $idCabecBD = $cabecDAO->idCabec($cab);
            $retAmostra = $this->salvarAmostra($idCabecBD, $cab->sampleList);
            $ret[] = array_merge($retAmostra, ["id" => $cab->id, "idServ" => $idCabecBD]);
        }
        return $ret;
    }

    private function salvarAmostra($idCabecBD, $amostraList)
    {
        $amostraDAO = new AmostraPerdaDAO();
        $retAmostraArray = array();
        foreach ($amostraList as $amostra) {
            $v = $amostraDAO->verifAmostra($idCabecBD, $amostra);
            if ($v <= 0) {
                $amostraDAO->insAmostra($idCabecBD, $amostra);
            }
            $idAmostraBD = $amostraDAO->idAmostra($idCabecBD, $amostra);
            $retAmostraArray['sampleList'] = [array("id" => $amostra->id, "idServ" => $idAmostraBD)];
        }
        return $retAmostraArray;
    }
}
