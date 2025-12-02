<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-container { max-width: 900px; margin: 30px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        .badge-admin { background: #333; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; }
        .badge-user { background: #228B22; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">Admin Usuários</div>
            <div class="user-actions">
                <a href="index.php?page=admin" class="account-btn" style="background:#666;">Gerenciar Cupons</a>
                <a href="index.php?page=home" class="account-btn">Voltar ao Site</a>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <h2 style="color: #228B22;">Lista de Usuários Cadastrados</h2>
        
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
                        <a href="index.php?page=admin-user-edit&id=<?= $u->id ?>" style="color: blue; margin-right: 10px;"><i class="fas fa-edit"></i></a>
                        
                        <a href="index.php?page=admin-user-delete&id=<?= $u->id ?>" 
                           style="color: red;" 
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