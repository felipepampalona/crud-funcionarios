<?php

namespace funcs\Models\helper;

use PDO;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Update
 *
 * @copyright (c) year, Luiz Felipe
 */
class Update extends StsConn {

    private $Tabela;
    private $Dados;
    private $Query;
    private $Conn;
    private $Resultado;
    private $Termos;
    private $Values;

    function getResultado() {
        return $this->Resultado;
    }

    public function exeUpdate($Tabela, array $Dados, $Termos = null, $ParseString = null) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Values);
        $this->getIntrucao();
        $this->executarInstrucao();
    }

    private function getIntrucao() {
        foreach ($this->Dados as $key => $Value) {
            $Values[] = $key . '= :' . $key;
        }
        $Values = implode(', ', $Values);
        $this->Query = "UPDATE {$this->Tabela} SET {$Values} {$this->Termos}";
    }

    private function executarInstrucao() {
        $this->conexao();
        try {
            $this->Query->execute(array_merge($this->Dados, $this->Values));
            $this->Resultado = true;
        } catch (Exception $ex) {
            $this->Resultado = null;
        }
    }

    private function conexao() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }

    public function conn($Query, array $Parametros = null) {
        $this->Query = $Query;
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
        try {
            $this->Query->execute($Parametros);
            $this->Resultado = true;
        } catch (Exception $ex) {
            //echo $ex;
            $this->Resultado = null;
        }
    }

}
