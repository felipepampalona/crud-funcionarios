<?php

namespace funcs\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CampoVazio
 *
 * @copyright (c) year, Luiz Felipe
 */
class CampoVazio
{

    private $Dados;
    private $Resultado;
    
    function getResultado()
    {
        return $this->Resultado;
    }

    
    public function validarDados(array $Dados)
    {
        $this->Dados = $Dados;
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário preencher todos os campos!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
