<?php

namespace funcs\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of NovoFuncionario
 *
 * @copyright (c) year, Luiz Felipe
 */
class NovoFuncionario
{

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $DadosCPF;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verUsuario($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \funcs\Models\helper\StsRead();
        $verPerfil->fullRead("SELECT * FROM `funcionario` WHERE `id`=:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

    public function cadUsuario(array $Dados)
    {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $this->Foto = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \funcs\Models\helper\CampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valCampos();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos()
    {
        $valEmail = new \funcs\Models\helper\Email();
        $valEmail->valEmail($this->Dados['email']);

        $valCpfUnico = new \funcs\Models\helper\valCpf();
        $valCpfUnico->ValCpf($this->Dados['cpf']);

        if (( $valEmail->getResultado()) AND ( $valCpfUnico->getResultado())) {
            $this->inserirFunc();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirFunc()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $slugImg = new \funcs\Models\helper\Slug();
        $this->Dados['foto'] = $slugImg->nomeSlug($this->Foto['name']);

        $cadFuncs = new \funcs\Models\helper\StsCreate;
        $cadFuncs->exeCreate("funcionario", $this->Dados);
        if ($cadFuncs->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Funcionário cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id'] = $cadFuncs->getResultado();
                $this->valFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O usuario não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function valFoto()
    {
        $uploadImg = new \funcs\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'assets/imagens/funcionario/' . $this->Dados['id'] . '/', $this->Dados['foto'], 150, 150);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Funcionário cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O funcionarionão foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }
    private function verCpf($DadosCPF)
    {
        $this->DadosCPF =  $DadosCPF;
        $verPerfil = new \funcs\Models\helper\StsRead();
        $verPerfil->fullRead("SELECT id FROM `funcionario` WHERE `cpf`=:cpf LIMIT :limit", "cpf=" . $this->DadosCPF . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado[0]['id'];
    }

    public function cadTelefone($Dados, $DadosCPF)
    {
        $this->Dados =  $Dados;
        $this->DadosCPF =  $DadosCPF;
        $inf =$this->verCpf($this->DadosCPF);
        $this->Dados['funcionario_id'] = $inf;

        $cadFuncs = new \funcs\Models\helper\StsCreate;
        $cadFuncs->exeCreate("telefone_funcionarios", $this->Dados);
        if ($cadFuncs->getResultado()) {
            $this->Resultado = true;
        }else{
            $this->Resultado = false;
        }
    }

}
