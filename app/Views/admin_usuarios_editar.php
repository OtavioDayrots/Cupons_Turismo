<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/global.css">
</head>
<body>
    <div class="container-editar">
        <h2>Editar Usuário</h2>
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
            <a href="index.php?page=admin-users" class="cancel-link">Cancelar</a>
        </form>
    </div>
</body>
</html>