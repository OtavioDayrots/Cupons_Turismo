<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuponeria Clone</title>
    <!-- CSS atualizado -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
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
                    
                    <div class="user-greeting">
                        Olá, <?= explode(' ', $_SESSION['usuario_nome'])[0] ?>
                    </div>

                    <!-- Botão ADMIN -->
                    <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'admin'): ?>
                        <a href="index.php?page=admin" class="account-btn btn-admin">
                            <i class="fas fa-cog"></i> <span>Admin</span>
                        </a>
                    <?php endif; ?>

                    <!-- Botão EMPRESA -->
                    <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'empresa'): ?>
                        <a href="index.php?page=empresa-painel" class="account-btn btn-empresa">
                            <i class="fas fa-store"></i> <span>Empresa</span>
                        </a>
                    <?php endif; ?>

                    <!-- Botão MEUS CUPONS -->
                    <a href="index.php?page=meus-cupons" class="account-btn btn-meus-cupons">
                        <i class="fas fa-ticket-alt"></i> <span>Meus Cupons</span>
                    </a>

                    <!-- Botão SAIR -->
                    <a href="index.php?page=logout" class="account-btn btn-sair">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>

                <?php else: ?>
                    <!-- NÃO LOGADO -->
                    
                    <a href="index.php?page=login" class="account-btn">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </a>

                    <a href="index.php?page=cadastro" class="account-btn btn-cadastrar-white">
                        Cadastrar
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </header>

    <section class="offers-section">
        <h2>Ofertas em Destaque</h2>
        <p>Aproveite os melhores descontos da região</p>
    </section>

    <!-- GRID DE CUPONS -->
    <section class="brands-section">
        <div class="brands-grid">
            
            <?php if (empty($cupons)): ?>
                <p class="empty-cupons">Nenhum cupom disponível no momento :(</p>
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
                                <div class="brand-info stock-esgotado">
                                    <i class="fas fa-times-circle"></i> ESGOTADO
                                </div>
                            <?php else: ?>
                                <div class="brand-info stock-disponivel">
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
                                <a href="index.php?page=login" class="btn-chrome btn-entrar-para-pegar">
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