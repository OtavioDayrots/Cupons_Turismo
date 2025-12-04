<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">Admin CupomTur</div>
            <div class="margin-top-10">
                <a href="index.php?page=admin-users" class="account-btn btn-admin-users">
                    <i class="fas fa-users"></i> Gerenciar Usuários
                </a>
            </div>
            <div class="user-actions">
                <a href="index.php?page=home" class="account-btn"><i class="fas fa-home"></i> Voltar ao Site</a>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <h2>Gerenciar Cupons</h2>

        <div class="admin-form-area">
            <h4>Adicionar Novo Cupom</h4>
            <form action="index.php?page=admin-store" method="POST">
                <div class="form-row">
                    <input type="text" name="nome" placeholder="Nome do Local (Ex: Hotel X)" required>
                    <input type="number" name="quantidade" placeholder="Qtd Cupons" required>
                    <input type="text" name="desconto" placeholder="% Off" required>
                </div>
                <div class="form-row">
                    <input type="text" name="imagem" placeholder="Caminho da Imagem (ex: img/karlton.jpg)" required>
                    <button type="submit" class="btn-cadastrar btn-save-inline">Salvar</button>
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
                        <td>
                            <?php
                            // Se a string começa com http:// ou https:// então é link de imagem
                            $img_src = '';
                            if (!empty($cupom->imagem)) {
                                if (preg_match('/^https?:\/\//', $cupom->imagem)) {
                                    $img_src = $cupom->imagem;
                                } else {
                                    // Remove barra inicial se presente para evitar duplicação de barras no caminho final
                                    $img_path = ltrim($cupom->imagem, '/');
                                    $img_src = BASE_URL . $img_path;
                                }
                            } else {
                                // Imagem ausente (padrão)
                                $img_src = 'https://via.placeholder.com/50x50?text=Sem+Imagem';
                            }
                            ?>
                            <img src="<?= htmlspecialchars($img_src) ?>" width="50" class="table-img"
                                onerror="this.src='https://via.placeholder.com/50x50?text=Erro'" alt="Imagem da Oferta">
                        </td>
                        <td><?= $cupom->nome ?></td>
                        <td><?= $cupom->quantidade ?></td>
                        <td>
                            <a href="index.php?page=admin-edit&id=<?= $cupom->id ?>" class="action-link">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                            <a href="index.php?page=admin-delete&id=<?= $cupom->id ?>" class="btn-delete"
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