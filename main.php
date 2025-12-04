<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupons turismo</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; padding-top: 50px; }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 { color: #333; text-align: center; margin-bottom: 20px; }

        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }

        /* Estilo do filtro de seleção */
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            background-color: #fff;
            cursor: pointer;
            outline: none;
            transition: border-color 0.3s;
        }

        select:focus { border-color: #007bff; }

        .resultado {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f5ff;
            color: #004085;
            border-radius: 5px;
            display: none; /* Escondido por padrão */
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Cupons Turismo</h1>

    <div class="card">
        <h2>Planeje sua Viagem</h2>
        
        <label for="filtro-cidades">Escolha o destino:</label>
        
        <select id="filtro-cidades">
            <option value="" selected disabled>Carregando cidades...</option>
        </select>

        <div id="box-resultado" class="resultado">
            Você selecionou: <strong id="texto-cidade"></strong>
        </div>
    </div>

    <script>
        // Quando a página carregar...
        document.addEventListener('DOMContentLoaded', () => {
            const selectElement = document.getElementById('filtro-cidades');
            const resultadoBox = document.getElementById('box-resultado');
            const textoCidade = document.getElementById('texto-cidade');

            // 1. Chama o arquivo PHP (Back-end)
            fetch('api_cidades.php')
                .then(response => response.json())
                .then(cidades => {
                    // Limpa o select
                    selectElement.innerHTML = '<option value="" selected disabled>-- Clique para selecionar --</option>';

                    // 2. Preenche o Select com os dados do PHP
                    cidades.forEach(cidade => {
                        const option = document.createElement('option');
                        option.value = cidade.id;
                        option.textContent = `${cidade.nome} - ${cidade.estado}`;
                        
                        // Destaque visual simples se for de MS (opcional)
                        if(cidade.estado === 'MS') {
                            option.style.fontWeight = 'bold';
                            option.textContent += ' (Região Pantanal/Centro)';
                        }
                        
                        selectElement.appendChild(option);
                    });
                })
                .catch(erro => {
                    console.error('Erro:', erro);
                    selectElement.innerHTML = '<option>Erro ao carregar</option>';
                });

            // 3. Evento ao selecionar uma opção
            selectElement.addEventListener('change', (e) => {
                // Pega o texto da opção selecionada (ex: Bonito - MS)
                const texto = e.target.options[e.target.selectedIndex].text;
                
                textoCidade.textContent = texto;
                resultadoBox.style.display = 'block';
            });
        });
    </script>
</body>
</html>