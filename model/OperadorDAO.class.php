<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of OperadorDAO
 *
 * @author anderson
 */
class OperadorDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                            . " A.CD AS \"matricOperador\" "
                        . "FROM "
                            . " COLAB A "
                            . " , CORR B "
                            . " , REG_DEMIS D "
                        . "  WHERE "
                            . " A.CORR_ID = B.CORR_ID "
                            . " AND "
                            . " A.CD > 11406 "
                            . " AND "
                            . " A.CD < 310000 "
                            . " AND "
                            . " D.COLAB_ID IS NULL "
                            . " AND "
                            . " A.COLAB_ID = D.COLAB_ID (+) "
                        . " ORDER BY A.CD ASC";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
