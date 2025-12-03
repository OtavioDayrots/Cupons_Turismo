<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuponeria Clone</title>
    <!-- CSS atualizado -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php?page=home">
                    <img src="img/cupturimg.png" alt="Cuponeria Logo">
                </a>
            </div>

            <!-- Botões do Usuário -->
            <div class="user-actions">
                
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- LOGADO -->
                    
                    <div style="color: white; font-weight: bold; font-size: 14px;">
                        Olá, <?= explode(' ', $_SESSION['usuario_nome'])[0] ?>
                    </div>

                    <!-- Botão ADMIN -->
                    <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'admin'): ?>
                        <a href="index.php?page=admin" class="account-btn" style="background-color: #333; border: 1px solid white;">
                            <i class="fas fa-cog"></i> <span style="font-size: 12px;">Admin</span>
                        </a>
                    <?php endif; ?>

                    <!-- Botão EMPRESA -->
                    <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'empresa'): ?>
                        <a href="index.php?page=empresa-painel" class="account-btn" style="background-color: #2c3e50; border: 1px solid white;">
                            <i class="fas fa-store"></i> <span style="font-size: 12px;">Empresa</span>
                        </a>
                    <?php endif; ?>

                    <!-- Botão MEUS CUPONS -->
                    <a href="index.php?page=meus-cupons" class="account-btn" style="background-color: #f1c40f; color: #333;">
                        <i class="fas fa-ticket-alt"></i> <span style="font-size: 12px;">Meus Cupons</span>
                    </a>

                    <!-- Botão SAIR -->
                    <a href="index.php?page=logout" class="account-btn" style="background-color: #d32f2f;">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>

                <?php else: ?>
                    <!-- NÃO LOGADO -->
                    
                    <a href="index.php?page=login" class="account-btn">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </a>

                    <a href="index.php?page=cadastro" class="account-btn" style="background-color: white; color: #228B22;">
                        Cadastrar
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </header>

    <section>
        <h2 style="text-align:center; margin-top:40px; color: #444;">Ofertas em Destaque</h2>
        <p style="text-align:center; color: #777; margin-bottom: 20px;">Aproveite os melhores descontos da região</p>
    </section>

    <!-- GRID DE CUPONS -->
    <section class="brands-section">
        <div class="brands-grid">
            
            <?php if (empty($cupons)): ?>
                <p style="text-align: center; width: 100%;">Nenhum cupom disponível no momento :(</p>
            <?php else: ?>

                <?php foreach ($cupons as $cupom): ?>
                    <!-- CARD INDIVIDUAL -->
                    <div class="brand-card">
                        
                        <!-- 1. Bolinha de Desconto (Só aparece se tiver valor) -->
                        <?php if(!empty($cupom->desconto)): ?>
                            <div class="discount-badge">
                                <?= $cupom->desconto ?>
                            </div>
                        <?php endif; ?>

                        <!-- 2. Imagem do Hotel -->
                        <img src="<?= $cupom->imagem ?>" alt="<?= $cupom->nome ?>" onerror="this.src='https://via.placeholder.com/250x150?text=Sem+Imagem'">

                        <!-- 3. Conteúdo (Texto) -->
                        <div class="card-content">
                            <div class="brand-name"><?= $cupom->nome ?></div>
                            
                            <!-- Estoque / Esgotado -->
                            <?php if($cupom->quantidade <= 0): ?>
                                <div class="brand-info" style="color: #e74c3c; font-weight: bold;">
                                    <i class="fas fa-times-circle"></i> ESGOTADO
                                </div>
                            <?php else: ?>
                                <div class="brand-info" style="color: #27ae60;">
                                    <i class="fas fa-check-circle"></i> <?= $cupom->quantidade ?> disponíveis
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- 4. Botão de Ação -->
                        <?php if ($cupom->quantidade > 0): ?>
                            
                            <?php if(isset($_SESSION['usuario_id'])): ?>
                                <a href="index.php?page=resgatar&id=<?= $cupom->id ?>" class="btn-chrome">
                                    Pegar Cupom
                                </a>
                            <?php else: ?>
                                <a href="index.php?page=login" class="btn-chrome" style="background-color: #333;">
                                    Entre para Pegar
                                </a>
                            <?php endif; ?>

                        <?php else: ?>
                            <!-- Botão Bloqueado -->
                            <button class="btn-chrome" disabled>Esgotado</button>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </section>

</body>
</html>