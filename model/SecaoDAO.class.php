<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of TalhaoDAO
 *
 * @author anderson
 */
class SecaoDAO extends OCI
{

    private $Conn;

    public function dados()
    {

        $select = " SELECT DISTINCT "
            . " NVL(PROPRAGR_ID, 0) AS \"idSection\" "
            . " , NVL(CD, 0) AS \"codSection\" "
            . " FROM "
            . " USINAS.V_INFEST_PROPRAGR ";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
    }
}
