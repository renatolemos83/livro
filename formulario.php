<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco
@$getId = $_GET['id'];  //pega id para ediçao caso exista

if (@$getId) { //se existir recupera os dados e tras os campos preenchidos
    $consulta = mysql_query("SELECT * FROM cadastro WHERE id = + $getId");
    $campo = mysql_fetch_array($consulta);
}

if (isset($_POST['cadastrar'])) {  // caso nao seja passado o id via GET cadastra 
    $nome = $_POST['nome'];  //pega o elemento com o pelo NAME 
    $descricao = $_POST['descricao']; //pega o elemento com o pelo NAME 
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $ano = $_POST['ano'];
    $editora = $_POST['editora'];

    $crud = new crud('cadastro');  // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->inserir("nome,descricao,autor,isbn,ano,editora,trash", "'$nome','$descricao', '$autor', '$isbn','$ano','$editora', '1'"); // utiliza a funçao INSERIR da classe 
    header("Location: index.php"); // redireciona para a listagem
}

if (isset($_POST['editar'])) { // caso  seja passado o id via GET edita 
    $nome = $_POST['nome']; //pega o elemento com o pelo NAME
    $descricao = $_POST['descricao'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $ano = $_POST['ano'];
    $editora = $_POST['editora'];
    $crud = new crud('cadastro'); // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->atualizar("nome='$nome',descricao='$descricao', autor='$autor' ,isbn='$isbn', ano='$ano', editora='$editora'", "id='$getId'"); // utiliza a funçao ATUALIZAR da classe crud
    header("Location: index.php"); // redireciona para a listagem
}

if (isset($_POST['excluir'])) { // caso  seja passado o id via GET edita 
    $crud = new crud('cadastro'); // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->excluir("trash=0'", "id='$getId'"); // utiliza a funçao ATUALIZAR da classe crud
    header("Location: index.php"); // redireciona para a listagem
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="css/main.css" rel="stylesheet" />
    </head>
    <body>
        <a href="index.php">Home</a> |
        <a href="lixeira.php">Lixeira</a>
        <form action="" method="post" ><!--   formulario carrega a si mesmo com o action vazio  -->
            <div class="grid_12">
                <div class="grid_4">
                    <div class="input-prepend">
                        <span class="add-on">Nome</span>
                        <input id="nome" name="nome" type="text" placeholder="Informe o nome" value="<?php echo $campo['nome']; ?>" />
                    </div>
                    <div class="input-prepend">
                        <span class="add-on">Descrição</span>
                        <input name="descricao" type="text" placeholder="Informe a descrição" value="<?php echo $campo['descricao']; ?>" />
                    </div>

                    <div class="input-prepend">
                        <span class="add-on">Autor</span>
                        <input id="autor" name="autor" type="text"  placeholder="Informe o Autor" value="<?php echo $campo['autor']; ?>"/>
                    </div>

                    <div class="input-prepend">
                        <span class="add-on">ISBN</span>
                        <input id="isbn" name="isbn" type="text" placeholder="Informe o ISBN" value="<?php echo $campo['isbn']; ?>"/>
                    </div>

                    <div class="input-prepend">
                        <span class="add-on">Ano</span>
                        <input id="ano" name="ano" type="text" placeholder="Informe o ano"  value="<?php echo $campo['ano']; ?>"/>
                    </div>

                    <div class="input-prepend">
                        <span class="add-on">Editora</span>
                        <input id="editora" name="editora" type="text" placeholder="Informe a Editora" value="<?php echo $campo['editora']; ?>" />
                    </div>
                    <?php
                    if (@!$campo['id']) { // se nao passar o id via GET nao está editando, mostra o botao de cadastro
                        ?>
                        <input type="submit" name="cadastrar" value="Cadastrar"  class="btn btn-small btn-success"/>
                        <input type="reset" name="" value="limpar"  class="btn btn-small btn-danger"/>
                    <?php } else { // se  passar o id via GET  está editando, mostra o botao de ediçao ?>
                        <input type="submit" name="editar" value="Editar" class="btn btn-small btn-success"/> 
                        <input type="reset" name="" value="limpar"  class="btn btn-small btn-danger"/>
                    <?php } ?>
                </div>
            </div>
        </form>
    </body>
</html>
<?php $con->disconnect(); // fecha conexao com o banco  ?>
