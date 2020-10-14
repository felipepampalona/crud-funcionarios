<?php

namespace App\funcs\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarCel
 *
 * @copyright (c) year, Luiz Felipe - Qi Agencia
 */
class ApagarCel {

    private $DadosId;
    private $Dados;

    public function index($DadosId = null) {
        $this->Dados = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarFuncionario = new \funcs\Models\DeleteFuncionario();
            $apagarFuncionario->ApagarTelId($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma funcinário!</div>";
        }
        $UrlDestino = URL . 'view-funcionario/' . $this->Dados;
        header("Location: $UrlDestino");
    }

}
