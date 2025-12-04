<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - CupomTur</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php?page=home">
                    <img src="img/cupturimg.png" width="200px" alt="logo">
                </a>
            </div>
            <div class="user-actions">
                <a href="index.php?page=home" class="account-btn">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </header>

    <div class="container-cadastro">
        <div class="card-cadastro">
            <h2>Bem-vindo de volta!</h2>
            <p>Acesse sua conta para ver seus cupons.</p>
            
            <form action="index.php?page=fazer-login" method="POST">
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Sua senha" required>
                </div>

                <button type="submit" class="btn-cadastrar">Entrar</button>
            </form>

            <div class="auth-link">
                Ainda não tem conta? <a href="index.php?page=cadastro">Cadastre-se</a>
            </div>
        </div>
    </div>

</body>
</html>