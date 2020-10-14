<?php

namespace funcs\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ViewFuncionario
 *
 * @copyright (c) year, Luiz Felipe
 */
class ViewFuncionario {

    private $Resultado;
    private $DadosId;

    public function verUsuario($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \funcs\Models\helper\StsRead();
        $verPerfil->fullRead("SELECT * FROM `funcionario` WHERE `id`=:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

    public function verContatos($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \funcs\Models\helper\StsRead();
        $verPerfil->fullRead("SELECT * FROM `telefone_funcionarios` WHERE `funcionario_id`=:id", "id=" . $this->DadosId);
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

}
