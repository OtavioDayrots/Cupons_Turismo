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
                <a href="index.php?page=home" class="account-btn">Ir para o Site</a>
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
            <form action="index.php?page=empresa-store" method="POST" class="create-offer-form">
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
                <?php if (count($meus_cupons) == 0): ?>
                    <tr>
                        <td colspan="4" class="table-empty">Nenhuma oferta criada ainda.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($meus_cupons as $cupom): ?>
                    <tr>
                        <td>
                            <?php
                            // Se a string começa com http:// ou https:// então é link de imagem
                            $img_src = '';
                            if (!empty($cupom->imagem)) {
                                if (preg_match('/^https?:\/\//', $cupom->imagem)) {
                                    $img_src = $cupom->imagem;
                                } else {
                                    // Remove barra inicial se presente para evitar duplicação de barras no caminho final
                                    $img_path = ltrim($cupom->imagem, '/');
                                    $img_src = BASE_URL . $img_path;
                                }
                            } else {
                                // Imagem ausente (padrão)
                                $img_src = 'https://via.placeholder.com/50x50?text=Sem+Imagem';
                            }
                            ?>
                            <img src="<?= htmlspecialchars($img_src) ?>" width="50" class="table-img"
                                onerror="this.src='https://via.placeholder.com/50x50?text=Erro'" alt="Imagem da Oferta">
                        </td>
                        <td><b><?= $cupom->desconto ?> OFF</b></td>
                        <td><b><?= $cupom->nome ?></b></td>
                        <td><?= $cupom->quantidade ?> un.</td>
                        <td>
                            <a href="index.php?page=empresa-delete&id=<?= $cupom->id ?>" class="delete-link"
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