<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require('../model/dao/AuditorDAO.class.php');
require('../model/dao/ColhedoraDAO.class.php');
require('../model/dao/ObservacaoDAO.class.php');
require('../model/dao/OperadorDAO.class.php');
require('../model/dao/OSDAO.class.php');
require('../model/dao/TipoAmostradorDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {

    public function dadosAuditor() {

        $auditorDAO = new AuditorDAO();

        $dados = array("dados"=>$auditorDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosColhedora() {

        $colhedoraDAO = new ColhedoraDAO();

        $dados = array("dados"=>$colhedoraDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosObservacao() {

        $observacaoDAO = new ObservacaoDAO();

        $dados = array("dados"=>$observacaoDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosOperador() {

        $operadorDAO = new OperadorDAO();

        $dados = array("dados"=>$operadorDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosOS() {

        $osDAO = new OSDAO();

        $dados = array("dados"=>$osDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosTipoAmostrador() {

        $tipoAmostradorDAO = new TipoAmostradorDAO();

        $dados = array("dados"=>$tipoAmostradorDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
}
