<?php

namespace funcs\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListarFuncionarios
 *
 * @copyright (c) year, Luiz Felipe
 */
class ListarFuncionarios
{
    private $Resultado;
    
    public function listar()
    {
        $listar = new \funcs\Models\helper\StsRead();
        $listar->exeRead("funcionario");
        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}
