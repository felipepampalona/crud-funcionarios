<?php

namespace funcs\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDelete
 *
 * @copyright (c) year,
 */
class StsDelete extends StsConn {

    private $Tabela;
    private $Termos;
    private $Values;
    private $Resultado;
    private $Query;
    private $Conn;

    function getResultado() {
        return $this->Resultado;
    }

    public function exeDelete($Tabela, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        parse_str($ParseString, $this->Values);

        $this->executarIntrucao();
    }

    private function executarIntrucao() {
        $this->Query = "DELETE FROM {$this->Tabela} {$this->Termos}";
        $this->connetion();
        try {
            $this->Query->execute($this->Values);
            $this->Resultado = true;
        } catch (Exception $ex) {
            $this->Resultado = false;
        }
    }

    private function connetion() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }

    public function conexao($query, array $parametros = null) {
        if ($parametros != null) {
            $this->Conn = parent::getConn();
            $this->Query = $this->Conn->prepare($query);
            try {
                $this->Query->execute($parametros);
                $this->Resultado = true;
            } catch (Exception $ex) {
                $this->Resultado = false;
            }
        } else {
            $this->Conn = parent::getConn();
            $this->Query = $this->Conn->exec($query);
            $this->Resultado = true;
        }
        return $this->Resultado;
    }

}
