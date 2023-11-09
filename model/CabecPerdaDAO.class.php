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
                        . " DATA = TO_DATE('" . $cabec->dthrCabec . "','DD/MM/YYYY')"
                        . " AND "
                        . " TIPO = " . $cabec->tipoColheitaCabec . " "
                        . " AND "
                        . " AUDITOR1 = " . $cabec->matricAuditor1Cabec . " "
                        . " AND "
                        . " TURNO = " . $cabec->nroTurnoCabec . " "
                        . " AND "
                        . " SECAO = " . $cabec->codSecaoCabec . " "
                        . " AND "
                        . " TALHAO = " . $cabec->nroTalhaoCabec . " "
                        . " AND "
                        . " OS = " . $cabec->nroOSCabec . " "
                        . " AND "
                        . " FRENTE = " . $cabec->codFrenteCabec . " "
                        . " AND "
                        . " COLHEDORA = " . $cabec->nroColhedoraCabec . " "
                        . " AND "
                        . " OPERADOR = " . $cabec->matricOperadorCabec . " ";
        
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
                . " , " . $cabec->tipoColheitaCabec . " "
                . " , " . $cabec->matricAuditor1Cabec . " "
                . " , " . $cabec->matricAuditor2Cabec . " "
                . " , " . $cabec->matricAuditor3Cabec . " "
                . " , TO_DATE('" . $cabec->dthrCabec . "','DD/MM/YYYY') "
                . " , SYSDATE "
                . " , " . $cabec->nroTurnoCabec . " "
                . " , " . $cabec->codSecaoCabec . " "
                . " , " . $cabec->nroTalhaoCabec . " "
                . " , " . $cabec->nroOSCabec . " "
                . " , " . $cabec->codFrenteCabec . " "
                . " , " . $cabec->nroColhedoraCabec . " "
                . " , " . $cabec->matricOperadorCabec . " "
                . " , 0) ";

        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    
        return $qtdeCab;
        
    }

    
}
