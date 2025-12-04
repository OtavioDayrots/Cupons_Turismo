<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">Admin Usuários</div>
            <div class="user-actions">
                <a href="index.php?page=admin" class="account-btn btn-gerenciar-cupons">Gerenciar Cupons</a>
                <a href="index.php?page=home" class="account-btn">Voltar ao Site</a>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <h2>Lista de Usuários Cadastrados</h2>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u->id ?></td>
                    <td><?= $u->nome ?></td>
                    <td><?= $u->email ?></td>
                    <td>
                        <?php if($u->nivel == 'admin'): ?>
                            <span class="badge-admin">ADMIN</span>
                        <?php else: ?>
                            <span class="badge-user">USUÁRIO</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?page=admin-user-edit&id=<?= $u->id ?>" class="action-link"><i class="fas fa-edit"></i></a>
                        
                        <a href="index.php?page=admin-user-delete&id=<?= $u->id ?>" 
                           class="action-link-red" 
                           onclick="return confirm('Tem certeza? Isso não pode ser desfeito.')">
                           <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>