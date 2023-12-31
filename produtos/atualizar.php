<?php
require_once "../src/funcoes-produtos.php";
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$dadosDoProduto = lerUmProduto($conexao, $id);

require_once "../src/funcoes-fabricantes.php";
$listaDeFabricantes = lerFabricantes($conexao);

if(isset($_POST['atualizar'])){
    $nomeProduto = filter_input(INPUT_POST, "nomeProduto", FILTER_SANITIZE_SPECIAL_CHARS);

    $idFabricante = filter_input(INPUT_POST, "fabricante", FILTER_SANITIZE_NUMBER_INT);

    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $estoque = filter_input(INPUT_POST, "estoque", FILTER_SANITIZE_NUMBER_INT);

    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

    atualizarProduto(
        $conexao, $id, $nomeProduto, $preco, $estoque, $descricao, $idFabricante);

    header("location:visualizar.php?status=sucesso");
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Produtos - Atualização</title>

    <link rel="stylesheet" href="../css/exemplo-crud-php.css">

</head>

<body>
    <h1>Produtos | UPDATE-SELECT</h1>

    <div class="center-inserir">
    <form action="#" method="post">

        <input type="hidden" name="id" value="<?=$dadosDoProduto['id']?>">

        <p>
            <label for="nomeProduto">Nome Produto:</label>

            <br>
            
            <input value="<?=$dadosDoProduto['nomeProduto']?>" type="text" name="nomeProduto" id="nomeProduto" required>
        </p>  

        <p>
            <label for="nome">Preço:</label>

            <input value="<?=$dadosDoProduto['preco']?>" type="number" min="10" max="10000" step="0.01" name="preco" id="preco" required>
        </p>
        
        <p>
            <label for="nome">Estoque:</label>

            <input value="<?=$dadosDoProduto['estoque']?>" type="number" min="1" max="100" name="estoque" id="estoque" required>
        </p>

        <p>
            <label for="descricao">Descrição:</label> 
            <!-- Para o textarea passamos o chamado dentro da propria tag -->
            <textarea name="descricao" id="descricao" cols="30" rows="3"><?=$dadosDoProduto['descricao']?></textarea>
        </p>
        
        <p>
            <label for="fabricante">Fabricante:</label>
            
            <select name="fabricante" id="fabricante" required>
    <?php foreach($listaDeFabricantes as $fabricante) {?>
            <option <?php if($dadosDoProduto['fabricante_id'] === $fabricante['id']) echo " selected ";?> 
            value="<?=$fabricante['id']?>"><?=$fabricante['nomeFabricante']?></option>    
    <?php } ?>
            </select>
        </p>  

    <button type="submit" name="atualizar">Atualizar Produto</button>
    </form>
    </div>

    <p class="center"><a href="./visualizar.php">Voltar</a></p>

</body>
</html>    