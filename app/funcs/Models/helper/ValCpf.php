<?php

namespace funcs\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ValCpf
 *
 * @copyright (c) year, Felipe
 */
class ValCpf
{

    private $Cpf;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function ValCpf($Cpf, $EditarUnico = null, $DadoId = null)
    {
        $this->Cpf = (string) $Cpf;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valCpf = new \funcs\Models\helper\StsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valCpf->fullRead("SELECT `id` FROM `funcionario` WHERE `cpf` =:Cpf AND id <>:id LIMIT :limit", "Cpf={$this->Cpf}&limit=1&id={$this->DadoId}");            
        }else{
            $valCpf->fullRead("SELECT `id` FROM `funcionario` WHERE `cpf` =:Cpf LIMIT :limit", "Cpf={$this->Cpf}&limit=1");
        }        
        $this->Resultado = $valCpf->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este CPF já está cadastrado!</div>";
            $this->Resultado = false;
        } else {
            $this->valCarctCpf();
        }
    }

    private function valCarctCpf()
    {
        if (stristr($this->Cpf, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Caracter ( ' ) utilizado no Cpf inválido!</div>";
            $this->Resultado = false;
        } else {
            if (stristr($this->Cpf, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Digite um CPF!</div>";
                $this->Resultado = false;
            } else {
                $this->valExtensCpf();
            }
        }
    }

    private function valExtensCpf()
    {
        if ((strlen($this->Cpf)) < 11) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cpf Incompleto!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
