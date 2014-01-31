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
      
        <a href="formulario.php">Cadastrar</a> |
        <a href="lixeira.php">Lixeira</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Ano</th>
                    <th>Editora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = mysql_query("SELECT * FROM cadastro where trash = 1"); // query que busca todos os dados da tabela PRODUTO onde nao estiver excluido
                while ($campo = mysql_fetch_array($consulta)) { // laço de repetiçao que vai trazer todos os resultados da consulta
                    ?>
                    <tr>
                        <td><?php echo $campo['nome']; // mostrando o campo NOME da tabela   ?> </td>
                        <td><?php echo $campo['descricao']; ?></td>
                        <td><?php echo $campo['autor']; ?> </td>
                        <td><?php echo $campo['isbn'] ?> </td>
                        <td><?php echo $campo['ano'] ?></td>
                        <td><?php echo $campo['editora'] ?></td>
                        <td>
                            <a href="formulario.php?id=<?php echo $campo['id']; //pega o campo ID para a ediçao    ?>">
                                <button class="btn btn-default btn-mini btn-default">EDITAR</button> 
                            </a>
                        </td>
                        <td>
                            <a href="excluir.php?id=<?php echo $campo['id']; ?>"><button class="btn btn-default btn-mini btn-danger">EXCLUIR</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
<?php
$con->disconnect(); // fecha conexao com o banco ?>