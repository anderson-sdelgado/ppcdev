<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of OSDAO
 *
 * @author anderson
 */
class OSDAO extends OCI
{

    private $Conn;

    public function dados($nroOS)
    {

        $select = " SELECT DISTINCT "
            . " NRO_OS AS \"nroOS\" "
            . " , NVL(PROPRAGR_ID, 0) AS \"idSection\" "
            . " FROM "
            . " USINAS.V_SIMOVA_OS_MANUAL "
            . " WHERE "
            . " NRO_OS = " . $nroOS;

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        $row = oci_fetch_assoc($statement);
        oci_free_statement($statement);
        return (object) $row;
    }
}
