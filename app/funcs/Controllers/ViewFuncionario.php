<?php

namespace App\funcs\Controllers;

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

    private $Dados;
    private $DadosId;

    public function index($DadosId = null) {

        $this->DadosId = (int) $DadosId;
        $this->Dados = filter_input_array(INPUT_POST);
        if (!empty($this->DadosId)) {
            $verUsuario = new \funcs\Models\ViewFuncionario();
            $this->Dados['dados_func'] = $verUsuario->verUsuario($this->DadosId);
            $this->Dados['contatos'] = $verUsuario->verContatos($this->DadosId);
            if (!empty($this->Dados['NovoCel'])) {
                unset($this->Dados['NovoCel']);
                $dados = array("funcionario_id" => $this->Dados['funcionario_id'], "telefone" => $this->Dados['telefone']);
                $addTel = new \funcs\Models\NovoFuncionario();
                $addTel->cadTelefoneId($dados);
            }


            $carregarView = new \Core\ConfigView("funcs/Views/view-funcionario", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Funcionario não encontrado!</div>";
            $UrlDestino = URL;
            header("Location: $UrlDestino");
        }
    }

}
