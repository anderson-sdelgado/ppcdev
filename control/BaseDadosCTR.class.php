<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require('../model/ColabDAO.class.php');
require('../model/ColhedoraDAO.class.php');
require('../model/OSDAO.class.php');
require('../model/SecaoDAO.class.php');
require('../model/TalhaoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR
{

    public function dadosColab()
    {
        $colabDAO = new ColabDAO();
        return json_encode($colabDAO->dados(), JSON_NUMERIC_CHECK);
    }

    public function dadosColhedora()
    {
        $colhedoraDAO = new ColhedoraDAO();
        return json_encode($colhedoraDAO->dados(), JSON_NUMERIC_CHECK);
    }

    public function dadosOS($nroOS)
    {
        $osDAO = new OSDAO();
        return json_encode($osDAO->dados($nroOS), JSON_NUMERIC_CHECK);
    }

    public function dadosTalhao()
    {
        $talhaoDAO = new TalhaoDAO();
        return json_encode($talhaoDAO->dados(), JSON_NUMERIC_CHECK);
    }

    public function dadosSecao()
    {
        $secaoDAO = new SecaoDAO();
        return json_encode($secaoDAO->dados(), JSON_NUMERIC_CHECK);
    }
}
