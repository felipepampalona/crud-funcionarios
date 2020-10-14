<?php

namespace funcs\Models;

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
    private $Dados;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarFuncionario($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $viewFunc = new \funcs\Models\ViewFuncionario();
        $this->Dados['tels'] = $viewFunc->verContatos($this->DadosId);
        $apagarFuncionario = new \funcs\Models\helper\StsDelete();
        if (isset($this->Dados['tels'])) {
            $this->ApagarTel($this->DadosId);
            $apagarFuncionario->exeDelete("funcionario", "WHERE id =:id", "id={$this->DadosId}");
            if ($apagarFuncionario->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>funcionario apagada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: funcionario não foi apagada!</div>";
                $this->Resultado = false;
            }
        } else {
            $apagarFuncionario = new \funcs\Models\helper\StsDelete();
            $apagarFuncionario->exeDelete("funcionario", "WHERE id =:id", "id={$this->DadosId}");
            if ($apagarFuncionario->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>funcionario apagada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: funcionario não foi apagada!</div>";
                $this->Resultado = false;
            }
        }
    }

    public function ApagarTel() {
        $apagarFuncionario = new \funcs\Models\helper\StsDelete();
        $apagarFuncionario->exeDelete("telefone_funcionarios", "WHERE funcionario_id =:id", "id={$this->DadosId}");
        if ($apagarFuncionario->getResultado()) {
            $this->Resultado = true;
        } else {
            $this->Resultado = false;
        }
    }

    public function ApagarTelId($DadosId = null) {
        $this->DadosId = $DadosId;
        $apagarFuncionario = new \funcs\Models\helper\StsDelete();
        $apagarFuncionario->exeDelete("telefone_funcionarios", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarFuncionario->getResultado()) {
            $this->Resultado = true;
        } else {
            $this->Resultado = false;
        }
    }

}
