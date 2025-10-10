<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of ColabDAO
 *
 * @author anderson
 */
class ColabDAO extends OCI
{

    private $Conn;

    public function dados()
    {

        $select = " SELECT DISTINCT "
            . " A.CD AS \"regColab\" "
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
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
    }
}
