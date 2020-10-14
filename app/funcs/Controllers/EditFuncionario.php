<?php

namespace App\funcs\Controllers;

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

    private $Dados;
    private $DadosId;

    public function index($DadosId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->privEdit();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Funcionario não encontrado!</div>";
            $UrlDestino = URL;
            header("Location: $UrlDestino");
        }
    }

    private function privEdit() {
        if (!empty($this->Dados['EditFunc'])) {
            unset($this->Dados['EditFunc']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            //var_dump($this->Dados);
            $editFunc = new \funcs\Models\EditFuncionario();
            $editFunc->altFuncionario($this->Dados);
            if ($editFunc->getResultado()) {
                $_SESSION['msg'] = "Editado com sucesso";
                $UrlDestino = URL;
                header("Location: $UrlDestino");
            } else {
                $_SESSION['msg'] = "Falha ao Editar";
                $UrlDestino = URL . 'edit-funcionario/' . $this->Dados['id'];
                header("Location: $UrlDestino");
            }
        } else {
            $verUsuario = new \funcs\Models\ViewFuncionario();
            $this->Dados['dados_func'] = $verUsuario->verUsuario($this->DadosId);

            $carregarView = new \Core\ConfigView("funcs/Views/edit-funcionario", $this->Dados);
            $carregarView->renderizar();
        }
    }

}
