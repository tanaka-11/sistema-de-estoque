<?php
require_once "../src/funcoes-fabricantes.php";

// Obtendo e sanitizando o valor vindo do parâmetro de URL
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$dadosDoFabricante = lerUmFabricante($conexao, $id);

if(isset($_POST['atualizar'])){
    $nomeFabricante = filter_input(INPUT_POST, "nomeFabricante", FILTER_SANITIZE_SPECIAL_CHARS);
    
    // Passar o id senão ira mudar todos.
    atualizarFabricante($conexao, $nomeFabricante, $id);

    header("location:visualizar.php?status=sucesso");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Fabricantes - Atualização</title>

    <link rel="stylesheet" href="../css/exemplo-crud-php.css">

</head>

<body>
    <h1>Fabricantes | UPDATE-SELECT</h1>

    <div class="center-inserir">

    <form action="#" method="post">

        <input type="hidden" name="id" value="<?=$dadosDoFabricante['id']?>">

        <p>
            <label for="nomeFabricante">Nome do Fabricante:</label>

            <br>
            
            <input value="<?=$dadosDoFabricante['nomeFabricante']?>" type="text" name="nomeFabricante" id="nomeFabricante" required>
        </p>

    <button type="submit" name="atualizar">Atualizar Fabricante</button>

    </form>
    </div>

    <p class="center"><a href="./visualizar.php">Voltar</a></p>

    <script src="../js/"></script>
</body>

</html>