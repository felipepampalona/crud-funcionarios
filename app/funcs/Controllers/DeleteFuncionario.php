<?php

namespace App\funcs\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of DeleteFuncionario
 *
 * @copyright (c) year, Luiz Felipe
 */
class DeleteFuncionario {

    private $DadosId;

    public function index($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarFuncionario = new \funcs\Models\DeleteFuncionario();
            $apagarFuncionario->apagarFuncionario($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma funcinário!</div>";
        }
        $UrlDestino = URL;
        header("Location: $UrlDestino");
    }

}
