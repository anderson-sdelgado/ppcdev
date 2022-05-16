<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of CabecPerdaDAO
 *
 * @author anderson
 */
class CabecPerdaDAO extends Conn {
    
    public function verifCabec($cabec) {

        $select = "SELECT "
                        . " COUNT(ID) AS QTDE "
                    . " FROM "
                        . " APONTAPERDACABECALHO "
                    . " WHERE "
                        . " DATA = TO_DATE('" . $cabec->data . "','DD/MM/YYYY')"
                        . " AND "
                        . " TIPO = " . $cabec->tipo . " "
                        . " AND "
                        . " AUDITOR1 = " . $cabec->auditor1 . " "
                        . " AND "
                        . " AUDITOR2 = " . $cabec->auditor2 . " "
                        . " AND "
                        . " AUDITOR3 = " . $cabec->auditor3 . " "
                        . " AND "
                        . " TURNO = " . $cabec->turno . " "
                        . " AND "
                        . " SECAO = " . $cabec->secao . " "
                        . " AND "
                        . " TALHAO = " . $cabec->talhao . " "
                        . " AND "
                        . " OS = " . $cabec->os . " "
                        . " AND "
                        . " FRENTE = " . $cabec->frente . " "
                        . " AND "
                        . " COLHEDORA = " . $cabec->colhedora . " "
                        . " AND "
                        . " OPERADOR = " . $cabec->operador . " ";

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
    
    public function insCabec($cabec) {

        $select = " SELECT "
                    . " MAX(ID) AS QTDE "
                    . " FROM "
                    . " APONTAPERDACABECALHO ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $qtdeCab = $item['QTDE'];
            $qtdeCab = $qtdeCab + 1;
        }

        if ($cabec->tipo == 1) {
            $cabec->tipo = 5;
        } else if ($cabec->tipo == 2) {
            $cabec->tipo = 6;
        }
        
        $sql = "INSERT INTO APONTAPERDACABECALHO ( "
                . " ID "
                . " , TIPO "
                . " , AUDITOR1 "
                . " , AUDITOR2 "
                . " , AUDITOR3 "
                . " , DATA "
                . " , DHENVIO "
                . " , TURNO "
                . " , SECAO "
                . " , TALHAO "
                . " , OS "
                . " , FRENTE "
                . " , COLHEDORA "
                . " , OPERADOR "
                . " , STATUS "
                . " ) VALUES ( "
                . " " . $qtdeCab . " "
                . " , " . $cabec->tipo . " "
                . " , " . $cabec->auditor1 . " "
                . " , " . $cabec->auditor2 . " "
                . " , " . $cabec->auditor3 . " "
                . " , TO_DATE('" . $cabec->data . "','DD/MM/YYYY') "
                . " , TO_DATE('" . $cabec->dhEnvio . "','DD/MM/YYYY HH24:MI') "
                . " , " . $cabec->turno . " "
                . " , " . $cabec->secao . " "
                . " , " . $cabec->talhao . " "
                . " , " . $cabec->os . " "
                . " , " . $cabec->frente . " "
                . " , " . $cabec->colhedora . " "
                . " , " . $cabec->operador . " "
                . " , 0) ";

        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    
        return $qtdeCab;
        
    }

    
}
