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
                . " PRU_PERDA_AMOSTRA "
                . " WHERE "
                . " SEQ = " . $amostra->seqAmostraPerda
                . " AND "
                . " CABEC_ID = " . $idCabec;

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
        
        $pedra = 0;
        $tocoArvore = 0;
        $plantaDaninha = 0;
        $formigueiros = 0;

        if ($amostra->obsv != 'null') {

            $dados = '';

            $qtdeObsv = strlen($amostra->obsv);

            for ($i = 0; $i < $qtdeObsv; $i++) {

                $d = $amostra->obsv{$i};

                if (($d != '.') && ($d != ' ')) {
                    $dados = $dados . $d;
                }

                if ($dados == 'PEDRA') {
                    $pedra = 1;
                    $dados = '';
                } else if ($dados == 'TOCODEARVORE') {
                    $tocoArvore = 1;
                    $dados = '';
                } else if ($dados == 'PLANTASDANINHAS') {
                    $plantaDaninha = 1;
                    $dados = '';
                } else if ($dados == 'FORMIGUEIROS') {
                    $formigueiros = 1;
                    $dados = '';
                }
            }
        }

        $tara = '';
        if ($amostra->tara == 0) {
            $tara = "null";
        } else {
            $tara = $amostra->tara;
        }

        $tolete = '';
        if ($amostra->tolete == 0) {
            $tolete = "null";
        } else {
            $tolete = ($amostra->tolete - $amostra->tara);
        }

        $canaInteira = '';
        if ($amostra->canaInteira == 0) {
            $canaInteira = "null";
        } else {
            $canaInteira = ($amostra->canaInteira - $amostra->tara);
        }

        $toco = '';
        if ($amostra->toco == 0) {
            $toco = "null";
        } else {
            $toco = ($amostra->toco - $amostra->tara);
        }

        $pedaco = '';
        if ($amostra->pedaco == 0) {
            $pedaco = "null";
        } else {
            $pedaco = ($amostra->pedaco - $amostra->tara);
        }

        $repique = '';
        if ($amostra->repique == 0) {
            $repique = "null";
        } else {
            $repique = ($amostra->repique - $amostra->tara);
        }

        $ponteiro = '';
        if ($amostra->ponteiro == 0) {
            $ponteiro = "null";
        } else {
            $ponteiro = ($amostra->ponteiro - $amostra->tara);
        }

        $lascas = '';
        if ($amostra->lascas == 0) {
            $lascas = "null";
        } else {
            $lascas = ($amostra->lascas - $amostra->tara);
        }

        $soqueiraKg = '';
        if ($amostra->soqueiraKg == 0) {
            $soqueiraKg = "null";
        } else {
            $soqueiraKg = ($amostra->soqueiraKg - $amostra->tara);
        }

        $soqueiraNum = '';
        if ($amostra->soqueiraNum == 0) {
            $soqueiraNum = "null";
        } else {
            $soqueiraNum = $amostra->soqueiraNum;
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
                . " , " . $amostra->num . " "
                . " , " . $tara . " "
                . " , " . $tolete . " "
                . " , " . $canaInteira . " "
                . " , " . $toco . " "
                . " , " . $pedaco . " "
                . " , " . $repique . " "
                . " , " . $ponteiro . " "
                . " , " . $lascas . " "
                . " , " . $soqueiraKg . " "
                . " , " . $soqueiraNum . " "
                . " , " . $pedra . " "
                . " , " . $tocoArvore . " "
                . " , " . $plantaDaninha . " "
                . " , " . $formigueiros . " "
                . " )";

        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
