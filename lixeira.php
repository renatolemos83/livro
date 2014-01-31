<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />

        <title></title>
    </head>
    <body>
        <a href="index.php">Home</a> |
        <a href="formulario.php">Cadastrar</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Nome
                    </th>
                    <th>
                        Descrição
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = mysql_query("SELECT * FROM cadastro where trash = 0"); // query que busca todos os dados da tabela
                while ($campo = mysql_fetch_array($consulta)) { // laço de repetiçao que vai trazer todos os resultados da consulta
                    ?>
                    <tr>
                        <td>
                            <?php echo $campo['nome']; // mostrando o campo NOME da tabela ?>
                        </td>
                        <td>
                            <?php echo $campo['descricao']; // mostrando o campo DESCRICAO da tabela ?>
                        </td>
                        <td>
                            <a href="restaurar.php?id=<?php echo $campo['id']; //pega o campo ID para a ediçao  ?>">
                                <button class="btn btn-default btn-mini btn-default">Restaurar</button> 
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
<?php
$con->disconnect(); // fecha conexao com o banco ?>