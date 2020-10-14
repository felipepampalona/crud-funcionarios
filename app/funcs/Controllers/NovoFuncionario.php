<?php

namespace App\funcs\Controllers;

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

   private $Dados;
   private $Telefone;

    public function index()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadFunc'])) {
            unset($this->Dados['CadFunc']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $this->Telefone = $this->Dados['telefone'];
            unset($this->Dados['telefone']);

             $cont = count($this->Telefone);

            $cadFunc = new \funcs\Models\NovoFuncionario();
            $cadFunc->cadUsuario($this->Dados);
            if ($cadFunc->getResultado()) {
                $cadFunc2 = new \funcs\Models\NovoFuncionario();
                for($i=0;$i<$cont;$i++){
                    $cadFunc2->cadTelefone(array("telefone"=>$this->Telefone[$i]),$this->Dados['cpf']);
                }
                if ($cadFunc2->getResultado()) {
                $UrlDestino = URL;
                header("Location: $UrlDestino");
            }else{
                $_SESSION['msg'] = "Falha ao cadastrar Telefone";
                $UrlDestino = URL;
                header("Location: $UrlDestino");
            }
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadFuncViewPriv();
            }
        } else {
            $this->cadFuncViewPriv();
        }
    }

    private function cadFuncViewPriv()
    {
        $carregarView = new \Core\ConfigView("funcs/Views/NovoFuncionario", $this->Dados);
        $carregarView->renderizar();
    }

}
