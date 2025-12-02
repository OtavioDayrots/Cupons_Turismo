<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <style>
        .container-editar { max-width: 500px; margin: 50px auto; padding: 30px; background: white; border-radius: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container-editar">
        <h2 style="color: #228B22;">Editar Usuário</h2>
        <form action="index.php?page=admin-user-update" method="POST">
            <input type="hidden" name="id" value="<?= $usuario->id ?>">

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" value="<?= $usuario->nome ?>" required>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" value="<?= $usuario->email ?>" required>
            </div>

            <div class="form-group">
                <label>Nível de Acesso</label>
                <select name="nivel">
                    <option value="usuario" <?= $usuario->nivel == 'usuario' ? 'selected' : '' ?>>Usuário Comum</option>
                    <option value="admin" <?= $usuario->nivel == 'admin' ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>

            <button type="submit" class="btn-cadastrar">Salvar Alterações</button>
            <a href="index.php?page=admin-users" style="display:block; text-align:center; margin-top:10px; color:#666;">Cancelar</a>
        </form>
    </div>
</body>
</html>