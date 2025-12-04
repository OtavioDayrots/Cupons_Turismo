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
                <a href="index.php?page=home" class="logo-link">
                    <img src="<?= BASE_URL ?>img/cupturimg.png" width="200px" alt="logo">
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
            <h2>Crie sua conta</h2>
            <p>Junte-se a nós para economizar!</p>
            
            <form action="index.php?page=salvar-usuario" method="POST" id="formCadastro">
                <div class="form-group">
                    <label>Tipo de Cadastro</label>
                    <select name="tipo_cadastro" id="tipoCadastro" required onchange="alternarDocumento()">
                        <option value="pessoa_fisica">Pessoa Física</option>
                        <option value="empresa">Empresa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label id="labelNome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" placeholder="Seu nome" required>
                </div>

                <div class="form-group" id="grupoDocumento">
                    <label id="labelDocumento">CPF</label>
                    <input type="text" name="documento" id="documento" placeholder="000.000.000-00" required>
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label>Celular</label>
                    <input type="text" name="celular" placeholder="(00) 00000-0000" required>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Crie uma senha forte" required>
                </div>

                <button type="submit" class="btn-cadastrar">Finalizar Cadastro</button>
            </form>
        </div>
    </div>

    <script>
        function alternarDocumento() {
            const tipoCadastro = document.getElementById('tipoCadastro').value;
            const labelDocumento = document.getElementById('labelDocumento');
            const inputDocumento = document.getElementById('documento');
            const labelNome = document.getElementById('labelNome');
            const inputNome = document.getElementById('nome');

            if (tipoCadastro === 'empresa') {
                labelDocumento.textContent = 'CNPJ';
                inputDocumento.placeholder = '00.000.000/0000-00';
                inputDocumento.setAttribute('maxlength', '18');
                labelNome.textContent = 'Razão Social';
                inputNome.placeholder = 'Nome da empresa';
            } else {
                labelDocumento.textContent = 'CPF';
                inputDocumento.placeholder = '000.000.000-00';
                inputDocumento.setAttribute('maxlength', '14');
                labelNome.textContent = 'Nome Completo';
                inputNome.placeholder = 'Seu nome';
            }
            inputDocumento.value = '';
        }

        // Máscara para CPF
        document.getElementById('documento').addEventListener('input', function(e) {
            const tipoCadastro = document.getElementById('tipoCadastro').value;
            let value = e.target.value.replace(/\D/g, '');
            
            if (tipoCadastro === 'empresa') {
                // Máscara CNPJ: 00.000.000/0000-00
                if (value.length <= 14) {
                    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/, '$1.$2.$3/$4-$5');
                }
            } else {
                // Máscara CPF: 000.000.000-00
                if (value.length <= 11) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, '$1.$2.$3-$4');
                }
            }
            e.target.value = value;
        });

        // Máscara para Celular
        document.querySelector('input[name="celular"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            }
            e.target.value = value;
        });
    </script>

</body>
</html>