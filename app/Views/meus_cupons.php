<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Cupons</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <img src="img/cupturimg.png" width="200px" alt="logo">
            </div>
            <div class="user-actions">
                <span style="color: white; margin-right: 15px;">Logado como:
                    <b><?= $_SESSION['usuario_nome'] ?></b></span>
                <a href="index.php?page=home" class="account-btn">
                    <i class="fas fa-arrow-left"></i> Voltar para Ofertas
                </a>
            </div>
        </div>
    </header>

    <div class="container-cadastro">
        <div style="width: 100%; max-width: 800px;">
            <h2 style="color: #228B22; margin-bottom: 20px;">Meus Cupons Resgatados</h2>

            <div class="brands-grid" style="justify-content: center;">

                <div class="brands-grid" style="justify-content: center; flex-wrap: wrap;">

                    <?php if (count($meus_cupons) > 0): ?>

                        <?php foreach ($meus_cupons as $item): ?>
                            <div class="brand-card" style="border: 2px solid #228B22; width: 250px;">

                                <div
                                    style="background: #228B22; color: white; padding: 5px; border-radius: 5px; margin-bottom: 10px; font-size: 12px;">
                                    RESGATADO EM <?= date('d/m/Y', strtotime($item->data_resgate)) ?>
                                </div>

                                <img src="<?= $item->imagem ?>" alt="Hotel" width="100px" style="border-radius:50%;">
                                <div class="brand-info" style="margin-top:5px; font-weight:bold;"><?= $item->nome_hotel ?></div>

                                <div style="color: #ff002b; font-weight: bold; font-size: 24px;">
                                    <?= isset($item->desconto) ? $item->desconto : 'Promo' ?> OFF
                                </div>

                                <div style="font-weight: 800; font-size: 18px; margin: 10px 0; color: #333;">
                                    <?= $item->codigo_unico ?>
                                </div>

                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $item->codigo_unico ?>"
                                    alt="QR Code" width="120px" style="margin-bottom: 10px;">

                                <div style="font-size: 11px; color: #666;">Apresente este código no local</div>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div style="text-align: center; padding: 40px;">
                            <h3>Você ainda não tem cupons 😢</h3>
                            <a href="index.php?page=home" class="btn-cadastrar" style="text-decoration:none;">Ver
                                Ofertas</a>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>

</body>

</html>