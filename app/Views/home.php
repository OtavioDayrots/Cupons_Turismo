<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuponeria Clone</title>
    <!-- Usa a constante BASE_URL definida no index.php -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php?page=home">
                    <!-- Ajuste o caminho da imagem se necessário -->
                    <img src="img/cupturimg.png" alt="Cuponeria Logo">
                </a>
            </div>

            <!-- Botões do Usuário -->
            <div class="user-actions">
                
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- USUÁRIO LOGADO -->
                    
                    <div style="color: white; font-weight: bold; font-size: 14px;">
                        Olá, <?= explode(' ', $_SESSION['usuario_nome'])[0] ?>
                    </div>

                    <!-- LÓGICA DE BOTÕES POR NÍVEL -->
                    <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'admin'): ?>
                        
                        <!-- 1. ADMIN: Vê apenas o botão do painel Admin -->
                        <a href="index.php?page=admin" class="account-btn" style="background-color: #333; border: 1px solid white;">
                            <i class="fas fa-cog"></i> <span style="font-size: 12px;">Painel Admin</span>
                        </a>

                    <?php elseif (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'empresa'): ?>
                        
                        <!-- 2. EMPRESA: Vê apenas o botão da Área da Empresa -->
                        <a href="index.php?page=empresa-painel" class="account-btn" style="background-color: #2c3e50; border: 1px solid white;">
                            <i class="fas fa-store"></i> <span style="font-size: 12px;">Área da Empresa</span>
                        </a>

                    <?php else: ?>
                        
                        <!-- 3. USUÁRIO COMUM: Vê o botão Meus Cupons -->
                        <a href="index.php?page=meus-cupons" class="account-btn" style="background-color: #f1c40f; color: #333;">
                            <i class="fas fa-ticket-alt"></i> <span style="font-size: 12px;">Meus Cupons</span>
                        </a>

                    <?php endif; ?>

                    <!-- Botão SAIR (Aparece para todos) -->
                    <a href="index.php?page=logout" class="account-btn" style="background-color: #d32f2f;">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>

                <?php else: ?>
                    <!-- NÃO LOGADO (Visitante) -->
                    
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
                            
                            <!-- Estoque -->
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

                        <!-- 4. LÓGICA DO BOTÃO (Admin e Empresa bloqueados) -->
                        <?php 
                            $is_admin = isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'admin';
                            $is_empresa = isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] == 'empresa';
                        ?>

                        <?php if ($is_admin || $is_empresa): ?>
                            
                            <!-- BLOQUEIO VISUAL PARA GESTORES -->
                            <div style="margin-top: 15px; font-size: 12px; color: #999; border-top: 1px solid #eee; width: 100%; padding-top: 10px;">
                                <i class="fas fa-lock"></i> Visão de Gestor
                            </div>

                        <?php else: ?>

                            <!-- USUÁRIO COMUM OU VISITANTE -->
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
                                <button class="btn-chrome" disabled>Esgotado</button>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </section>