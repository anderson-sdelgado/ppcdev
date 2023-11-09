<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of AmostraPerdaDAO
 *
 * @author anderson
 */
class AmostraPerdaDAO extends Conn {
    
    public function verifAmostra($idCabec, $amostra) {

        $select = " SELECT "
                    . " COUNT(ID) AS QTDE "
                . " FROM "
                    . " APONTAPERDAAMOSTRA "
                . " WHERE "
                    . " IDCEL = " . $amostra->idAmostra
                . " AND "
                    . " IDCABEC = " . $idCabec;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
        
    }
    
    public function insAmostra($idCabec, $amostra) {

        $tara = '';
        if ($amostra->taraAmostra == 0) {
            $tara = "null";
        } else {
            $tara = $amostra->taraAmostra;
        }

        $tolete = '';
        if ($amostra->toleteAmostra == 0) {
            $tolete = "null";
        } else {
            $tolete = ($amostra->toleteAmostra - $amostra->taraAmostra);
        }

        $canaInteira = '';
        if ($amostra->canaInteiraAmostra == 0) {
            $canaInteira = "null";
        } else {
            $canaInteira = ($amostra->canaInteiraAmostra - $amostra->taraAmostra);
        }

        $toco = '';
        if ($amostra->tocoAmostra == 0) {
            $toco = "null";
        } else {
            $toco = ($amostra->tocoAmostra - $amostra->taraAmostra);
        }

        $pedaco = '';
        if ($amostra->pedacoAmostra == 0) {
            $pedaco = "null";
        } else {
            $pedaco = ($amostra->pedacoAmostra - $amostra->taraAmostra);
        }

        $repique = '';
        if ($amostra->repiqueAmostra == 0) {
            $repique = "null";
        } else {
            $repique = ($amostra->repiqueAmostra - $amostra->taraAmostra);
        }

        $ponteiro = '';
        if ($amostra->ponteiroAmostra == 0) {
            $ponteiro = "null";
        } else {
            $ponteiro = ($amostra->ponteiroAmostra - $amostra->taraAmostra);
        }

        $lascas = '';
        if ($amostra->lascasAmostra == 0) {
            $lascas = "null";
        } else {
            $lascas = ($amostra->lascasAmostra - $amostra->taraAmostra);
        }

        $select = " SELECT "
                        . "COUNT(*) AS QTDE "
                    . "FROM "
                        . "APONTAPERDAAMOSTRA ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $qtdeItem = $item['QTDE'];
            $qtdeItem = $qtdeItem + 1;
        }
        
        $select = " SELECT "
                        . "COUNT(*) AS QTDE "
                    . "FROM "
                        . "APONTAPERDAAMOSTRA "
                . " WHERE "
                    . " IDCABEC = " . $idCabec;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $seqItem = $item['QTDE'];
            $seqItem = $seqItem + 1;
        }

        $sql = "INSERT INTO APONTAPERDAAMOSTRA ( "
                . " ID "
                . " , IDCABEC "
                . " , NUM "
                . " , TARA "
                . " , TOLETE "
                . " , CANAINTEIRA "
                . " , TOCO "
                . " , PEDACO "
                . " , REPIQUE "
                . " , PONTEIRO "
                . " , LASCAS "
                . " , SOQUEIRAKG "
                . " , SOQUEIRANUM "
                . " , PEDRA "
                . " , TOCOARVORE "
                . " , PLDANINHAS "
                . " , FORMIGUEIRO "
                . " ) VALUES( "
                . " " . $qtdeItem
                . " , " . $idCabec . " "
                . " , " . $seqItem . " "
                . " , " . $tara . " "
                . " , " . $tolete . " "
                . " , " . $canaInteira . " "
                . " , " . $toco . " "
                . " , " . $pedaco . " "
                . " , " . $repique . " "
                . " , " . $ponteiro . " "
                . " , " . $lascas . " "
                . " , null "
                . " , null "
                . " , " . $amostra->pedraAmostra . " "
                . " , " . $amostra->tocoArvoreAmostra . " "
                . " , " . $amostra->plantaDaninhasAmostra . " "
                . " , " . $amostra->formigueiroAmostra . " "
                . " )";

        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
