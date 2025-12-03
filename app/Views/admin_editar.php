<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Cupom</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container-editar {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">Admin</div>
        </div>
    </header>

    <div class="container-editar">
        <h2 style="color: #228B22; margin-bottom: 20px;">Editar Cupom #<?= $cupom->id ?></h2>

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

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-cadastrar" style="margin: 0;">Salvar Alterações</button>
                <a href="index.php?page=admin" class="btn-cadastrar"
                    style="background: #ccc; text-decoration: none; text-align: center;">Cancelar</a>
            </div>
        </form>
    </div>

</body>

</html>