<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área da Empresa</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .empresa-container { max-width: 900px; margin: 30px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .welcome-header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .table-empresa { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .table-empresa th { text-align: left; border-bottom: 2px solid #eee; padding: 10px; color: #666; }
        .table-empresa td { border-bottom: 1px solid #eee; padding: 10px; }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">Parceiro CupomTur</div>
            <div class="user-actions">
                <a href="index.php?page=home" class="account-btn">Ir para o Site</a>
            </div>
        </div>
    </header>

    <div class="empresa-container">
        
        <div class="welcome-header">
            <div>
                <h2>Olá, <?= $_SESSION['usuario_nome'] ?>!</h2>
                <p>Gerencie suas ofertas aqui.</p>
            </div>
            <div style="text-align: right;">
                <span style="font-size: 24px; font-weight: bold;"><?= count($meus_cupons) ?></span>
                <div>Cupons Ativos</div>
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; border: 1px dashed #ccc;">
            <h4 style="margin-bottom: 15px; color: #228B22;"><i class="fas fa-plus-circle"></i> Criar Nova Oferta</h4>
            <form action="index.php?page=empresa-store" method="POST" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <input type="text" name="nome" placeholder="Título da Oferta (Ex: 50% Off)" required style="flex: 2; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <input type="number" name="quantidade" placeholder="Qtd" required style="width: 80px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <input type="text" name="imagem" placeholder="Link da Imagem (img/exemplo.png)" required style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <input type="text" name="desconto" placeholder="% Off (ex: 20%)" required style="width: 100px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <button type="submit" class="btn-cadastrar" style="margin: 0; width: auto; padding: 0 30px;">Publicar</button>
            </form>
        </div>

        <h3 style="margin-top: 30px; color: #333;">Minhas Ofertas Publicadas</h3>
        <table class="table-empresa">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($meus_cupons) == 0): ?>
                    <tr><td colspan="4" style="text-align:center; padding: 20px;">Nenhuma oferta criada ainda.</td></tr>
                <?php endif; ?>

                <?php foreach ($meus_cupons as $cupom): ?>
                <tr>
                    <td><img src="<?= $cupom->imagem ?>" width="50" style="border-radius: 5px;"></td>
                    <td><b><?= $cupom->nome ?></b></td>
                    <td><?= $cupom->quantidade ?> un.</td>
                    <td>
                        <a href="index.php?page=empresa-delete&id=<?= $cupom->id ?>" 
                           style="color: red; text-decoration: none; font-weight: bold;"
                           onclick="return confirm('Apagar esta oferta?')">
                           <i class="fas fa-trash"></i> Apagar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>
</html>