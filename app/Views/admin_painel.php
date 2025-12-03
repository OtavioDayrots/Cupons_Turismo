<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-container { max-width: 900px; margin: 30px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        .btn-delete { color: red; cursor: pointer; text-decoration: none; font-weight: bold; }
        .form-row { display: flex; gap: 10px; margin-bottom: 10px; }
        .form-row input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">Admin CupomTur</div>
            <div style="margin-top: 10px;">
                <a href="index.php?page=admin-users" class="account-btn" style="background: #2c3e50; color: white;">
                    <i class="fas fa-users"></i> Gerenciar Usuários
                </a>
            </div>
            <div class="user-actions">
                <a href="index.php?page=home" class="account-btn"><i class="fas fa-home"></i> Voltar ao Site</a>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <h2 style="color: #228B22;">Gerenciar Cupons</h2>
        
        <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 30px;">
            <h4>Adicionar Novo Cupom</h4>
            <form action="index.php?page=admin-store" method="POST">
                <div class="form-row">
                    <input type="text" name="nome" placeholder="Nome do Local (Ex: Hotel X)" required>
                    <input type="number" name="quantidade" placeholder="Qtd Cupons" required>
                    <input type="text" name="desconto" placeholder="% Off" required>
                </div>
                <div class="form-row">
                    <input type="text" name="imagem" placeholder="Caminho da Imagem (ex: img/karlton.jpg)" required>
                    <button type="submit" class="btn-cadastrar" style="width: auto; margin:0;">Salvar</button>
                </div>
            </form>
        </div>

        <h4>Cupons Cadastrados</h4>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Qtd</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cupons as $cupom): ?>
                <tr>
                    <td><?= $cupom->id ?></td>
                    <td><img src="<?= $cupom->imagem ?>" width="40px" style="border-radius:50%;"></td>
                    <td><?= $cupom->nome ?></td>
                    <td><?= $cupom->quantidade ?></td>
                    <td>
                        <a href="index.php?page=admin-edit&id=<?= $cupom->id ?>" 
                        style="color: blue; margin-right: 10px; text-decoration: none; font-weight: bold;">
                        <i class="fas fa-edit"></i> Editar
                        </a>

                        <a href="index.php?page=admin-delete&id=<?= $cupom->id ?>" 
                        class="btn-delete" 
                        onclick="return confirm('Tem certeza que deseja apagar?')">
                        <i class="fas fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>