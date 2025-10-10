<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCI.class.php');
/**
 * Description of AmostraPerdaDAO
 *
 * @author anderson
 */
class AmostraPerdaDAO extends OCI
{

    private $Conn;

    public function verifAmostra($idCabec, $amostra)
    {

        $select = " SELECT "
            . " COUNT(ID) AS QTDE "
            . " FROM "
            . " APONTAPERDAAMOSTRA "
            . " WHERE "
            . " IDCEL = " . $amostra->id
            . " AND "
            . " NUM = " . $amostra->pos
            . " AND "
            . " IDCABEC = " . $idCabec;

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

    public function idAmostra($idCabec, $amostra)
    {

        $select = " SELECT "
            . " ID AS ID "
            . " FROM "
            . " APONTAPERDAAMOSTRA "
            . " WHERE "
            . " IDCEL = " . $amostra->id
            . " AND "
            . " NUM = " . $amostra->pos
            . " AND "
            . " IDCABEC = " . $idCabec;

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

    public function insAmostra($idCabec, $amostra)
    {

        $anthill = 0;
        if ($amostra->anthill) {
            $anthill = 1;
        }

        $castorOilPlant = 0;
        if ($amostra->castorOilPlant) {
            $castorOilPlant = 1;
        }

        $guineaGrass = 0;
        if ($amostra->guineaGrass) {
            $guineaGrass = 1;
        }

        $mucuna = 0;
        if ($amostra->mucuna) {
            $mucuna = 1;
        }

        $signalGrass = 0;
        if ($amostra->signalGrass) {
            $signalGrass = 1;
        }

        $silkGrass = 0;
        if ($amostra->silkGrass) {
            $silkGrass = 1;
        }

        $stone = 0;
        if ($amostra->stone) {
            $stone = 1;
        }

        $treeStump = 0;
        if ($amostra->treeStump) {
            $treeStump = 1;
        }

        $weed = 0;
        if ($amostra->weed) {
            $weed = 1;
        }

        $piece = isset($amostra->piece) ? $amostra->piece : null;
        if (!empty($piece)) {
            $piece = $piece - $amostra->tare;
        } else {
            $piece = 'null';
        }

        $slivers = isset($amostra->slivers) ? $amostra->slivers : null;
        if (!empty($slivers)) {
            $slivers = $slivers - $amostra->tare;
        } else {
            $slivers = 'null';
        }

        $stalk = isset($amostra->stalk) ? $amostra->stalk : null;
        if (!empty($stalk)) {
            $stalk = $stalk - $amostra->tare;
        } else {
            $stalk = 'null';
        }

        $stump = isset($amostra->stump) ? $amostra->stump : null;
        if (!empty($stump)) {
            $stump = $stump - $amostra->tare;
        } else {
            $stump = 'null';
        }

        $tip = isset($amostra->tip) ? $amostra->tip : null;
        if (!empty($tip)) {
            $tip = $tip - $amostra->tare;
        } else {
            $tip = 'null';
        }

        $wholeCane = isset($amostra->wholeCane) ? $amostra->wholeCane : null;
        if (!empty($wholeCane)) {
            $wholeCane = $wholeCane - $amostra->tare;
        } else {
            $wholeCane = 'null';
        }

        $pos = (int) $amostra->pos;
        $tare = (float) $amostra->tare;
        $id = (int) $amostra->id;
        $idCabec = (int)$idCabec;

        $sql = "INSERT INTO APONTAPERDAAMOSTRA ( "
            . " IDCABEC "
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
            . " , CAPIMCOLONIAO "
            . " , MAMONA "
            . " , CAPIMBRAQUIARIA "
            . " , MUCUNA "
            . " , GRAMASEDA "
            . " , IDCEL "
            . " ) VALUES( "
            . " :p_id_cabec "
            . " , :p_pos "
            . " , " . $tare
            . " , " . $stalk
            . " , " . $wholeCane
            . " , " . $stump
            . " , " . $piece
            . " , null "
            . " , " . $tip
            . " , " . $slivers
            . " , null "
            . " , null "
            . " , :p_stone "
            . " , :p_tree_stump "
            . " , :p_weed "
            . " , :p_anthill "
            . " , :p_guinea_grass "
            . " , :p_castor_oil_plant "
            . " , :p_signal_grass "
            . " , :p_mucuna "
            . " , :p_silk_grass "
            . " , :p_id "
            . " )";

        $this->Conn = parent::getConn();
        $result = oci_parse($this->Conn, $sql);
        oci_bind_by_name($result, ":p_id_cabec", $idCabec);
        oci_bind_by_name($result, ":p_anthill", $anthill);
        oci_bind_by_name($result, ":p_castor_oil_plant", $castorOilPlant);
        oci_bind_by_name($result, ":p_guinea_grass", $guineaGrass);
        oci_bind_by_name($result, ":p_mucuna", $mucuna);
        oci_bind_by_name($result, ":p_signal_grass", $signalGrass);
        oci_bind_by_name($result, ":p_silk_grass", $silkGrass);
        oci_bind_by_name($result, ":p_stone", $stone);
        oci_bind_by_name($result, ":p_tree_stump", $treeStump);
        oci_bind_by_name($result, ":p_weed", $weed);
        oci_bind_by_name($result, ":p_pos", $pos);
        oci_bind_by_name($result, ":p_id", $id);
        oci_execute($result);
    }
}
