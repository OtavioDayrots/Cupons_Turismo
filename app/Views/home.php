<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CupomTur</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <img src="img/cupturimg.png" width="200px" alt="logo do site">
            </div>

            <div class="search-area">
                <button class="location-btn"><i class="fas fa-map-marker-alt"></i> Campo Grande/MS</button>
                <input type="text" class="search-input" placeholder="buscar ofertas">
            </div>

            <div class="user-actions">

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <div style="color: white; font-weight: bold; display: flex; align-items: center; gap: 10px;">
                        <span>Olá, <?= $_SESSION['usuario_nome'] ?>!</span>
                    </div>

                    <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'admin'): ?>
                        <a href="index.php?page=admin" class="account-btn"
                            style="background-color: #333;   border: 1px solid white;">
                            <i class="fas fa-cog"></i>
                            <div>
                                <div style="font-size: 10px;">Painel Admin</div>
                            </div>
                        </a>
                    <?php endif; ?>

                    <a href="index.php?page=meus-cupons" class="account-btn"
                        style="background-color: #f1c40f; color: #333;">
                        <i class="fas fa-ticket-alt"></i>
                        <div>
                            <div style="font-size: 10px;">Meus Cupons</div>
                        </div>
                    </a>

                    <a href="index.php?page=logout" class="account-btn" style="background-color: #d32f2f;">
                        <i class="fas fa-sign-out-alt"></i>
                        <div>
                            <div style="font-size: 10px;">Sair</div>
                        </div>
                    </a>

                <?php else: ?>
                    <a href="index.php?page=login" class="account-btn">
                        <i class="fas fa-user-circle"></i>
                        <div>
                            <div style="font-size: 10px;">Entrar</div>
                        </div>
                    </a>

                    <a href="index.php?page=cadastro" class="account-btn">
                        <i class="fas fa-user-circle"></i>
                        <div>
                            <div style="font-size: 10px;">Cadastrar</div>
                        </div>
                    </a>

                <?php endif; ?>

            </div>
        </div>
    </header>

    <section>
        <h2 style="text-align:center; margin-top:20px;">Cupons em destaque</h2>
    </section>

    <section class="brands-section">
        <div class="brands-grid">

            <?php foreach ($cupons as $cupom): ?>
                <div class="brand-card">
                    <img src="<?= $cupom->imagem ?>" alt="<?= $cupom->nome ?>" width="150px">
                    <div class="brand-info"><?= $cupom->quantidade ?> cupons disponíveis</div>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <a href="index.php?page=resgatar&id=<?= $cupom->id ?>" class="btn-chrome"
                            style="text-decoration: none; font-size: 14px; padding: 10px 20px;">
                            Pegar Cupom
                        </a>
                    <?php else: ?>
                        <a href="index.php?page=login" class="btn-chrome"
                            style="background:#ccc; text-decoration: none; font-size: 14px; padding: 10px 20px;">
                            Entre para Pegar
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

</body>

</html>