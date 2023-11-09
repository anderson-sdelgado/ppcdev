<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of TalhaoDAO
 *
 * @author anderson
 */
class TalhaoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                    . " TALHAO.TALHAO_ID AS \"idTalhao\" "
                    . " , TALHAO.PROPRAGR_ID AS \"idSecao\" "
                    . " , TALHAO.NRO AS \"codTalhao\" "
                . " FROM "
                    . " INTERFACE.V_OS_AGRICOLA_MANUAL OS "
                    . " , USINAS.V_INFEST_TALHAO TALHAO "
                . " WHERE "
                    . " OS.PROPRAGR_ID = TALHAO.PROPRAGR_ID ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
