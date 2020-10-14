<?php

namespace funcs\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditFuncionario
 *
 * @copyright (c) year, Luiz Felipe
 */
class EditFuncionario {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $ImgAntiga;

    function getResultado() {
        return $this->Resultado;
    }

    public function altFuncionario(array $Dados) {
        $this->Dados = $Dados;

        $this->Foto = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];

        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);
        //var_dump($this->Dados);
        $valCampoVazio = new \funcs\Models\helper\CampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valCampos();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos() {
        $valEmail = new \funcs\Models\helper\Email();
        $valEmail->valEmail($this->Dados['email']);

        if ($valEmail->getResultado()) {
            $this->valFoto();
        } else {
            $this->Resultado = false;
        }
    }

    private function valFoto() {
        if (empty($this->Foto['name'])) {
            $this->updateEditFuncionario();
        } else {
            $slugImg = new \funcs\Models\helper\Slug();
            $this->Dados['foto'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \funcs\Models\helper\AdmsUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'assets/imagens/funcionario/' . $this->Dados['id'] . '/', $this->Dados['foto'], 150, 150);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \funcs\Models\helper\ApagarImg();
                $apagarImg->apagarImg('assets/imagens/funcionario/' . $this->Dados['id'] . '/' . $this->ImgAntiga);
                $this->updateEditFuncionario();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditFuncionario() {

        $upFuncionario = new \funcs\Models\helper\Update();
        $upFuncionario->exeUpdate("funcionario", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upFuncionario->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Funcionario atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Funcionario não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

}
