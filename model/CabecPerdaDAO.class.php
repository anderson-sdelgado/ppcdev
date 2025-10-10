<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of CabecPerdaDAO
 *
 * @author anderson
 */
class CabecPerdaDAO extends OCI
{

    private $Conn;

    public function verifCabec($cabec)
    {
        $select = "SELECT "
            . " COUNT(ID) AS QTDE "
            . " FROM "
            . " APONTAPERDACABECALHO "
            . " WHERE "
            . " DTHR_CEL = TO_DATE('" . $cabec->dateHour . "','DD/MM/YYYY HH24:MI')"
            . " AND "
            . " ID_CEL = " . $cabec->id;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            foreach ($row as $item) {
                $v = $item;
            }
        }
        return $v;
    }


    public function idCabec($cabec)
    {

        $select = "SELECT "
            . " ID AS ID "
            . " FROM "
            . " APONTAPERDACABECALHO "
            . " WHERE "
            . " DTHR_CEL = TO_DATE('" . $cabec->dateHour . "','DD/MM/YYYY HH24:MI')"
            . " AND "
            . " ID_CEL = " . $cabec->id;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            foreach ($row as $item) {
                $v = $item;
            }
        }
        return $v;
    }

    public function insCabec($cabec)
    {
        $sql = "INSERT INTO APONTAPERDACABECALHO (
            TIPO,
            AUDITOR1,
            AUDITOR2,
            AUDITOR3,
            DATA,
            DHENVIO,
            TURNO,
            SECAO,
            TALHAO,
            OS,
            FRENTE,
            COLHEDORA,
            OPERADOR,
            STATUS,
            ID_CEL,
            NRO_APARELHO,
            DTHR_CEL
        ) VALUES (
            5,
            :p_regAuditor1,
            :p_regAuditor2,
            :p_regAuditor3,
            TO_DATE(:p_date, 'DD/MM/YYYY'),
            SYSDATE,
            :p_nroTurn,
            :p_codSection,
            :p_nroPlot,
            :p_nroOS,
            :p_codFront,
            :p_nroHarvester,
            :p_regOperator,
            0,
            :p_id,
            :p_number,
            TO_DATE(:p_dateHour, 'DD/MM/YYYY HH24:MI')
        )";

        $this->Conn = parent::getConn();
        $result = oci_parse($this->Conn, $sql);
        oci_bind_by_name($result, ":p_id", $cabec->id);
        oci_bind_by_name($result, ":p_regAuditor1", $cabec->regAuditor1);
        oci_bind_by_name($result, ":p_regAuditor2", $cabec->regAuditor2);
        oci_bind_by_name($result, ":p_regAuditor3", $cabec->regAuditor3);
        oci_bind_by_name($result, ":p_date", $cabec->date);
        oci_bind_by_name($result, ":p_nroTurn", $cabec->nroTurn);
        oci_bind_by_name($result, ":p_codSection", $cabec->codSection);
        oci_bind_by_name($result, ":p_nroPlot", $cabec->nroPlot);
        oci_bind_by_name($result, ":p_nroOS", $cabec->nroOS);
        oci_bind_by_name($result, ":p_codFront", $cabec->codFront);
        oci_bind_by_name($result, ":p_nroHarvester", $cabec->nroHarvester);
        oci_bind_by_name($result, ":p_regOperator", $cabec->regOperator);
        oci_bind_by_name($result, ":p_dateHour", $cabec->dateHour);
        oci_bind_by_name($result, ":p_number", $cabec->number);
        oci_execute($result);
    }
}
