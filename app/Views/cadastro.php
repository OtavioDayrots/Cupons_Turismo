<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar - CupomTur</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <a href="main.php?page=home" class="logo-link">
                    <img src="<?= BASE_URL ?>img/cupturimg.png" width="200px" alt="logo">
                </a>
            </div>
            <div class="user-actions">
                <a href="main.php?page=home" class="account-btn">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </header>

    <div class="container-cadastro">
        <div class="card-cadastro">
            <h2>Crie sua conta</h2>
            <p>Junte-se a nós para economizar!</p>
            
            <form action="main.php?page=salvar-usuario" method="POST">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" placeholder="Seu nome" required>
                </div>

                <div class="form-group">
                    <label>CPF</label>
                    <input type="number" name="CPF" placeholder="Seu CPF" required>
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label>Celular</label>
                    <input type="number" name="celular" placeholder="Seu numero de celular" required>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Crie uma senha forte" required>
                </div>

                <button type="submit" class="btn-cadastrar">Finalizar Cadastro</button>
            </form>
        </div>
    </div>

</body>
</html>