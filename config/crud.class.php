<?php

class crud {

    private $sql_ins = "";
    private $tabela = "";
    private $sql_sel = "";

    public function __construct($tabela) { // construtor, nome da tabela como parametro
        $this->tabela = $tabela;
        return $this->tabela;
    }

    public function inserir($campos, $valores) { // funçao de inserçao, campos e seus respectivos valores como parametros
        $this->sql_ins = "INSERT INTO " . $this->tabela . " ($campos) VALUES ($valores)";
        if (!$this->ins = mysql_query($this->sql_ins)) {
            die("<center>Erro na inclusão " . '<br>Linha: ' . __LINE__ . "<br>" . mysql_error() . "<br>
				<a href='index.php'>Voltar ao Menu</a></center>");
        } else {
            print "<script>location='index.php';</script>";
        }
    }

    public function atualizar($camposvalores, $where = NULL) { // funçao de ediçao, campos com seus respectivos valores e o campo id que define a linha a ser editada como parametros
        if ($where) {
            $this->sql_upd = "UPDATE  " . $this->tabela . " SET $camposvalores WHERE $where";
        } else {
            $this->sql_upd = "UPDATE  " . $this->tabela . " SET $camposvalores";
        }

        if (!$this->upd = mysql_query($this->sql_upd)) {
            die("<center>Erro na atualização " . "<br>Linha: " . __LINE__ . "<br>" . mysql_error() . "<br>
				<a href='index.php'>Voltar ao Menu</a></center>");
        } else {
            print "<center>Registro Atualizado com Sucesso!<br><a href='index.php'>Voltar ao Menu</a></center>";
        }
    }

    public function excluir($where = NULL) {
        if ($where) {
            $this->sql_upd = "UPDATE  " . $this->tabela . " SET trash=0 WHERE $where";
        }

        if (!$this->upd = mysql_query($this->sql_upd)) {
            die("<center>Erro na atualização " . "<br>Linha: " . __LINE__ . "<br>" . mysql_error() . "<br>
				<a href='index.php'>Voltar ao Menu</a></center>");
        } else {
            print "<center>Registro enviado para a lixeirea com Sucesso!<br><a href='index.php'>Voltar ao Menu</a></center>";
        }
    }

    public function lixeira($where = NULL) {
        if ($where) {
            $this->sql_upd = "UPDATE  " . $this->tabela . " SET trash=1 WHERE $where";
        }

        if (!$this->upd = mysql_query($this->sql_upd)) {
            die("<center>Erro na atualização " . "<br>Linha: " . __LINE__ . "<br>" . mysql_error() . "<br>
				<a href='index.php'>Voltar ao Menu</a></center>");
        } else {
            print "<center>Registro enviado para a lixeirea com Sucesso!<br><a href='index.php'>Voltar ao Menu</a></center>";
        }
    }

}
?>

