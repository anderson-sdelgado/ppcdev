<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require('../control/AtualAplicCTR.class.php');
require('../model/AuditorDAO.class.php');
require('../model/ColhedoraDAO.class.php');
require('../model/OperadorDAO.class.php');
require('../model/OSDAO.class.php');
require('../model/TalhaoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {

    public function dadosAuditor($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $auditorDAO = new AuditorDAO();

            $dados = array("dados"=>$auditorDAO->dados());
            $retJson = json_encode($dados);

            return $retJson;
        
        }

    }
    
    public function dadosColhedora($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $colhedoraDAO = new ColhedoraDAO();

            $dados = array("dados"=>$colhedoraDAO->dados());
            $retJson = json_encode($dados);

            return $retJson;
        
        }

    }
    
    
    public function dadosOperador($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $operadorDAO = new OperadorDAO();

            $dados = array("dados"=>$operadorDAO->dados());
            $retJson = json_encode($dados);

            return $retJson;
        
        }

    }
    
    public function dadosOS($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $osDAO = new OSDAO();

            $dados = array("dados"=>$osDAO->dados());
            $retJson = json_encode($dados);

            return $retJson;
        
        }

    }
    
        
    public function dadosTalhao($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $talhaoDAO = new TalhaoDAO();

            $dados = array("dados"=>$talhaoDAO->dados());
            $retJson = json_encode($dados);

            return $retJson;
        
        }

    }
    
}
