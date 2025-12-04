<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área da Empresa</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">Parceiro CupomTur</div>
            <div class="user-actions">
                <a href="main.php?page=home" class="account-btn">Ir para o Site</a>
            </div>
        </div>
    </header>

    <div class="empresa-container">
        
        <div class="welcome-header">
            <div>
                <h2>Olá, <?= $_SESSION['usuario_nome'] ?>!</h2>
                <p>Gerencie suas ofertas aqui.</p>
            </div>
            <div class="welcome-header-right">
                <span class="welcome-header-count"><?= count($meus_cupons) ?></span>
                <div>Cupons Ativos</div>
            </div>
        </div>

        <div class="create-offer-area">
            <h4 class="create-offer-title"><i class="fas fa-plus-circle"></i> Criar Nova Oferta</h4>
            <form action="main.php?page=empresa-store" method="POST" class="create-offer-form">
                <input type="text" name="nome" placeholder="Título da Oferta (Ex: 50% Off)" required>
                <input type="number" name="quantidade" placeholder="Qtd" required>
                <input type="text" name="imagem" placeholder="Link da Imagem (img/exemplo.png)" required>
                <input type="text" name="desconto" placeholder="% Off (ex: 20%)" required>
                <button type="submit" class="btn-cadastrar">Publicar</button>
            </form>
        </div>

        <h3 class="my-offers-title">Minhas Ofertas Publicadas</h3>
        <table class="table-empresa">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($meus_cupons) == 0): ?>
                    <tr><td colspan="4" class="table-empty">Nenhuma oferta criada ainda.</td></tr>
                <?php endif; ?>

                <?php foreach ($meus_cupons as $cupom): ?>
                <tr>
                    <td><img src="<?= $cupom->imagem ?>" width="50" class="table-img"></td>
                    <td><b><?= $cupom->nome ?></b></td>
                    <td><?= $cupom->quantidade ?> un.</td>
                    <td>
                        <a href="main.php?page=empresa-delete&id=<?= $cupom->id ?>" 
                           class="delete-link"
                           onclick="return confirm('Apagar esta oferta?')">
                           <i class="fas fa-trash"></i> Apagar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>
</html>