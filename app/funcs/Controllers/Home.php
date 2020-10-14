<?php

namespace App\funcs\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Home
 *
 * @copyright (c) year, Luiz Felipe
 */
class Home
{

    private $Dados;

    public function index()
    {
        $listar = new \funcs\Models\ListarFuncionarios();
        $this->Dados['funcionarios'] = $listar->Listar();

        /*$listar_art_home = new \Sts\Models\StsArtHome();
        $this->Dados['sts_artigos'] = $listar_art_home->listarArtHome();*/

        $carregarView = new \Core\ConfigView("funcs/Views/home", $this->Dados);
        $carregarView->renderizar();
    }

}
