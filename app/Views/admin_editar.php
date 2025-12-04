<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Cupom</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">Admin</div>
        </div>
    </header>

    <div class="container-editar">
        <h2>Editar Cupom #<?= $cupom->id ?></h2>

        <form action="index.php?page=admin-update" method="POST">
            <input type="hidden" name="id" value="<?= $cupom->id ?>">

            <div class="form-group">
                <label>Nome do Local</label>
                <input type="text" name="nome" value="<?= $cupom->nome ?>" required>
            </div>

            <div class="form-group">
                <label>Quantidade</label>
                <input type="number" name="quantidade" value="<?= $cupom->quantidade ?>" required>
            </div>

            <div class="form-group">
                <label>Caminho da Imagem</label>
                <input type="text" name="imagem" value="<?= $cupom->imagem ?>" required>
            </div>

            <div class="form-group">
                <label>Porcentagem de Desconto</label>
                <input type="text" name="desconto" value="<?= $cupom->desconto ?>" required>
            </div>

            <div class="button-container">
                <button type="submit" class="btn-cadastrar">Salvar Alterações</button>
                <a href="index.php?page=admin" class="btn-cadastrar">Cancelar</a>
            </div>
        </form>
    </div>

</body>

</html>