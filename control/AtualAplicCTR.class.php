<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../model/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicCTR
 *
 * @author anderson
 */
class AtualAplicCTR
{
    //put your code here

    public function inserirDados($body)
    {
        $config = json_decode($body);
        return $this->inserirAtualVersao($config->number, $config->version);
    }

    public function inserirAtualVersao($nroAparelho, $versao)
    {
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verAtual($nroAparelho);
        if ($v == 0) {
            $atualAplicDAO->insAtual($nroAparelho, $versao);
        }
        $data = $atualAplicDAO->dadoAtual($nroAparelho);
        $atualAplicDAO->updAtual($nroAparelho, $versao, $data["idServ"]);
        return $data;
    }

    public function verifToken($info)
    {

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $token = $d->token;
        }

        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verToken($token);

        if ($v > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verToken($token)
    {
        $token = trim(substr($token, 6));
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verToken($token);
        if ($v > 0) {
            return true;
        } else {
            return false;
        }
    }
}
