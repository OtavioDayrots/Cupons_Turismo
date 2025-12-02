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
                <span style="color: white; margin-right: 15px;">Logado como: <b><?= $_SESSION['usuario_nome'] ?></b></span>
                <a href="index.php?page=home" class="account-btn">
                    <i class="fas fa-arrow-left"></i> Voltar para Ofertas
                </a>
            </div>
        </div>
    </header>

    <div class="container-cadastro"> <div style="width: 100%; max-width: 800px;">
            <h2 style="color: #228B22; margin-bottom: 20px;">Meus Cupons Resgatados</h2>

            <div class="brands-grid" style="justify-content: center;">
                
                <div class="brand-card" style="border: 2px solid #228B22;">
                    <div style="background: #228B22; color: white; padding: 5px; border-radius: 5px; margin-bottom: 10px; font-size: 12px;">RESGATADO</div>
                    <img src="img/karlton.jpg" alt="Hotel" width="100px">
                    <div class="brand-info">Hotel Karlton</div>
                    <div style="font-weight: bold; font-size: 20px; margin: 10px 0;">CÓDIGO: #DESC50</div>
                    <button style="background: #ccc; cursor: not-allowed;">Utilizar Agora</button>
                </div>

                <div class="brand-card">
                    <p style="padding: 20px; color: #666;">Você ainda não tem outros cupons.</p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>