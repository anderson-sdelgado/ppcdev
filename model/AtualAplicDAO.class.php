<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of AtualizaAplicDAO
 *
 * @author anderson
 */
class AtualAplicDAO extends OCIAPEX
{

    /** @var PDO */
    private $Conn;

    public function verAtual($nroAparelho)
    {

        $select = "SELECT "
            . " COUNT(*) AS QTDE "
            . " FROM "
            . " PPC_ATUAL "
            . " WHERE "
            . " NRO_APARELHO = " . $nroAparelho;

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

    public function verToken($token)
    {

        $select = "SELECT "
            . " COUNT(*) AS QTDE "
            . " FROM "
            . " PPC_ATUAL "
            . " WHERE "
            . " TOKEN = '" . $token . "'";

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

    public function insAtual($nroAparelho, $versao)
    {

        $sql = "INSERT INTO PPC_ATUAL ("
            . " NRO_APARELHO "
            . " , VERSAO "
            . " , DTHR_ULT_ACESSO "
            . " , TOKEN "
            . " , VERSAO_UPDATE "
            . " ) "
            . " VALUES ("
            . " " . $nroAparelho
            . " , '" . $versao . "'"
            . " , SYSDATE "
            . " , '" . strtoupper(md5('PPC-' . $versao . '-' . $nroAparelho)) . "'"
            . " , '" . $versao . "'"
            . " )";

        $this->Conn = parent::getConn();
        $result = oci_parse($this->Conn, $sql);
        oci_execute($result);
    }

    public function dadoAtual($nroAparelho)
    {

        $select = "SELECT "
            . " ID AS \"idServ\" "
            . " , VERSAO_UPDATE AS \"versionUpdate\" "
            . " FROM "
            . " PPC_ATUAL "
            . " WHERE "
            . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        return $row;
    }

    public function updAtual($nroAparelho, $versao, $idServ)
    {

        $sql = "UPDATE PPC_ATUAL "
            . " SET "
            . " VERSAO = '" . $versao . "'"
            . " , DTHR_ULT_ACESSO = SYSDATE "
            . " , TOKEN = '" . strtoupper(md5('PPC-' . $versao . '-' . $nroAparelho . '-' . $idServ)) . "'"
            . " WHERE "
            . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $result = oci_parse($this->Conn, $sql);
        oci_execute($result);
    }
}
