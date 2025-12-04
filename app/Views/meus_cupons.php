<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Cupons</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <img src="<?= BASE_URL ?>img/cupturimg.png" width="200px" alt="logo">
            </div>
            <div class="user-actions">
                <span class="header-user-info">Logado como:
                    <b><?= $_SESSION['usuario_nome'] ?></b></span>
                <a href="main.php?page=home" class="account-btn">
                    <i class="fas fa-arrow-left"></i> Voltar para Ofertas
                </a>
            </div>
        </div>
    </header>

    <div class="container-cadastro">
        <div class="meus-cupons-container">
            <h2 class="meus-cupons-title">Meus Cupons Resgatados</h2>

            <div class="brands-grid brands-grid-centered">

                    <?php if (count($meus_cupons) > 0): ?>

                        <?php foreach ($meus_cupons as $item): ?>
                            <div class="brand-card cupom-resgatado-card">

                                <div class="resgate-badge">
                                    RESGATADO EM <?= date('d/m/Y', strtotime($item->data_resgate)) ?>
                                </div>

                                <img src="<?= BASE_URL . $item->imagem ?>" alt="Hotel" width="100px" class="cupom-img-rounded">
                                <div class="brand-info cupom-hotel-name"><?= $item->nome_hotel ?></div>

                                <div class="cupom-desconto">
                                    <?= isset($item->desconto) ? $item->desconto : 'Promo' ?> OFF
                                </div>

                                <div class="cupom-codigo">
                                    <?= $item->codigo_unico ?>
                                </div>

                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $item->codigo_unico ?>"
                                    alt="QR Code" width="120px" class="cupom-qrcode">

                                <div class="cupom-instruction">Apresente este código no local</div>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="empty-cupons-message">
                            <h3>Você ainda não tem cupons 😢</h3>
                            <a href="main.php?page=home" class="btn-cadastrar">Ver
                                Ofertas</a>
                        </div>
                    <?php endif; ?>

            </div>
        </div>
    </div>

</body>

</html>