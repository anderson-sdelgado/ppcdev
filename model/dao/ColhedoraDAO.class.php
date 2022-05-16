<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of Colhedora
 *
 * @author anderson
 */
class ColhedoraDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                            . " NRO AS \"idColhedora\" "
                    . " FROM "
                            . " USINAS.V_INTEGRA_EQUIPAMENTO "
                    . " WHERE "
                            . " TIPO_CLASSE = 2  "
                            . " AND  "
                            . " NRO <> 9999999999 "
                    . " ORDER BY "
                            . " NRO "
                    . " ASC ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
