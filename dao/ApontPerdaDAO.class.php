<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of ApontPerdaDAO
 *
 * @author anderson
 */
class ApontPerdaDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosCab, $dadosAmostra) {

        foreach ($dadosCab as $c) {

            $select = " SELECT MAX(ID) AS QTDE FROM APONTAPERDACABECALHO ";

            $this->Conn = parent::getConn();
            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $qtdeCab = $item['QTDE'];
                $qtdeCab = $qtdeCab + 1;
            }

            if ($c->tipo == 1) {
                $c->tipo = 5;
            } else if ($c->tipo == 2) {
                $c->tipo = 6;
            }

            $select = "SELECT "
                    . " COUNT(ID) AS QTDE "
                    . " FROM "
                    . " APONTAPERDACABECALHO "
                    . " WHERE "
                    . " DATA = TO_DATE('" . $c->data . "','DD/MM/YYYY')"
                    . "AND TIPO = " . $c->tipo . " "
                    . "AND AUDITOR1 = " . $c->auditor1 . " "
                    . "AND AUDITOR2 = " . $c->auditor2 . " "
                    . "AND AUDITOR3 = " . $c->auditor3 . " "
                    . "AND TURNO = " . $c->turno . " "
                    . "AND SECAO = " . $c->secao . " "
                    . "AND TALHAO = " . $c->talhao . " "
                    . "AND OS = " . $c->os . " "
                    . "AND FRENTE = " . $c->frente . " "
                    . "AND COLHEDORA = " . $c->colhedora . " "
                    . "AND OPERADOR = " . $c->operador . " ";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $v = $item['QTDE'];
            }

            if ($v == 0) {

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
                        . " , " . $c->tipo . " "
                        . " , " . $c->auditor1 . " "
                        . " , " . $c->auditor2 . " "
                        . " , " . $c->auditor3 . " "
                        . " , TO_DATE('" . $c->data . "','DD/MM/YYYY') "
                        . " , TO_DATE('" . $c->dhEnvio . "','DD/MM/YYYY HH24:MI') "
                        . " , " . $c->turno . " "
                        . " , " . $c->secao . " "
                        . " , " . $c->talhao . " "
                        . " , " . $c->os . " "
                        . " , " . $c->frente . " "
                        . " , " . $c->colhedora . " "
                        . " , " . $c->operador . " "
                        . " , 0) ";

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                foreach ($dadosAmostra as $a) {

                    if ($c->id == $a->idCabecalho) {

                        $pedra = 0;
                        $tocoArvore = 0;
                        $plantaDaninha = 0;
                        $formigueiros = 0;

                        if ($a->obsv != 'null') {

                            $dados = '';

                            $qtdeObsv = strlen($a->obsv);

                            for ($i = 0; $i < $qtdeObsv; $i++) {

                                $d = $a->obsv{$i};

                                if (($d != '.') && ($d != ' ')) {
                                    $dados = $dados . $d;
                                }

                                if ($dados == 'PEDRA') {
                                    $pedra = 1;
                                    $dados = '';
                                } else if ($dados == 'TOCODEARVORE') {
                                    $tocoArvore = 1;
                                    $dados = '';
                                } else if ($dados == 'PLANTASDANINHAS') {
                                    $plantaDaninha = 1;
                                    $dados = '';
                                } else if ($dados == 'FORMIGUEIROS') {
                                    $formigueiros = 1;
                                    $dados = '';
                                }
                            }
                        }

                        $tara = '';
                        if ($a->tara == 0) {
                            $tara = "null";
                        } else {
                            $tara = $a->tara;
                        }

                        $tolete = '';
                        if ($a->tolete == 0) {
                            $tolete = "null";
                        } else {
                            $tolete = ($a->tolete - $a->tara);
                        }

                        $canaInteira = '';
                        if ($a->canaInteira == 0) {
                            $canaInteira = "null";
                        } else {
                            $canaInteira = ($a->canaInteira - $a->tara);
                        }

                        $toco = '';
                        if ($a->toco == 0) {
                            $toco = "null";
                        } else {
                            $toco = ($a->toco - $a->tara);
                        }

                        $pedaco = '';
                        if ($a->pedaco == 0) {
                            $pedaco = "null";
                        } else {
                            $pedaco = ($a->pedaco - $a->tara);
                        }

                        $repique = '';
                        if ($a->repique == 0) {
                            $repique = "null";
                        } else {
                            $repique = ($a->repique - $a->tara);
                        }

                        $ponteiro = '';
                        if ($a->ponteiro == 0) {
                            $ponteiro = "null";
                        } else {
                            $ponteiro = ($a->ponteiro - $a->tara);
                        }

                        $lascas = '';
                        if ($a->lascas == 0) {
                            $lascas = "null";
                        } else {
                            $lascas = ($a->lascas - $a->tara);
                        }

                        $soqueiraKg = '';
                        if ($a->soqueiraKg == 0) {
                            $soqueiraKg = "null";
                        } else {
                            $soqueiraKg = ($a->soqueiraKg - $a->tara);
                        }

                        $soqueiraNum = '';
                        if ($a->soqueiraNum == 0) {
                            $soqueiraNum = "null";
                        } else {
                            $soqueiraNum = $a->soqueiraNum;
                        }
                        $select = " SELECT COUNT(*) AS QTDE FROM APONTAPERDAAMOSTRA ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();

                        foreach ($result as $item) {
                            $qtdeItem = $item['QTDE'];
                            $qtdeItem = $qtdeItem + 1;
                        }

                        $sql = "INSERT INTO APONTAPERDAAMOSTRA ( "
                                . " ID "
                                . " , IDCABEC "
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
                                . " ) VALUES( "
                                . " " . $qtdeItem
                                . " , " . $qtdeCab . " "
                                . " , " . $a->num . " "
                                . " , " . $tara . " "
                                . " , " . $tolete . " "
                                . " , " . $canaInteira . " "
                                . " , " . $toco . " "
                                . " , " . $pedaco . " "
                                . " , " . $repique . " "
                                . " , " . $ponteiro . " "
                                . " , " . $lascas . " "
                                . " , " . $soqueiraKg . " "
                                . " , " . $soqueiraNum . " "
                                . " , " . $pedra . " "
                                . " , " . $tocoArvore . " "
                                . " , " . $plantaDaninha . " "
                                . " , " . $formigueiros . " "
                                . " )";

                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();
                    }
                }
            }
        }
    }

}
