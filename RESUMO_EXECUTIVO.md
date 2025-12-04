# 📄 Resumo Executivo - Sistema de Cupons de Turismo

## 🎯 Sobre o Projeto

Sistema web desenvolvido em **PHP** para gerenciamento de cupons de desconto para estabelecimentos turísticos. Permite que usuários resgatem cupons, empresas criem ofertas e administradores gerenciem todo o sistema.

## ⚡ Início Rápido (3 passos)

### 1. Iniciar Servidores
```
XAMPP Control Panel → Start Apache e MySQL
```

### 2. Criar Banco de Dados
```
phpMyAdmin → Importar → SQL/estruturas.sql
```

### 3. Acessar
```
http://localhost/Cupons_Turismo/
```

## 📁 Estrutura Principal

```
Cupons_Turismo/
├── app/
│   ├── Controllers/    # Lógica de negócio
│   ├── Models/         # Acesso ao banco
│   └── Views/         # Interface HTML
├── public/
│   ├── css/           # Estilos
│   └── img/           # Imagens
├── SQL/
│   └── estruturas.sql # Script do banco
└── index.php           # Ponto de entrada
```

## 🔑 Credenciais Padrão

**Banco de Dados (XAMPP):**
- Host: `localhost`
- Database: `cupons-turismo`
- User: `root`
- Password: *(vazio)*

**Criar Admin:**
1. Cadastre-se no sistema
2. No phpMyAdmin:
   ```sql
   UPDATE usuarios SET nivel = 'admin' WHERE email = 'seu_email@aqui.com';
   ```

## 🎨 Tecnologias

- **Backend:** PHP 7.4+, MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Arquitetura:** MVC
- **Ícones:** Font Awesome

## 📚 Documentação Disponível

1. **README.md** - Documentação completa
2. **INSTALACAO.md** - Guia rápido de instalação
3. **DOCUMENTACAO_TECNICA.md** - Detalhes técnicos
4. **CHECKLIST_AVALIACAO.md** - Lista de verificação

## ✨ Funcionalidades Principais

### 👤 Usuário
- Cadastro/Login
- Visualizar cupons
- Resgatar cupons
- Ver cupons resgatados (com QR Code)

### 🏢 Empresa
- Criar ofertas
- Gerenciar estoque
- Excluir ofertas

### 👨‍💼 Admin
- Gerenciar todos os cupons
- Gerenciar usuários
- Alterar níveis de acesso

## 🔧 Configuração Rápida

**Se o projeto estiver em outro caminho:**

Edite `index.php` linha 6:
```php
define('BASE_URL', 'http://localhost/SEU_CAMINHO/public/');
```

**Se o MySQL tiver senha:**

Edite `app/Models/Database.php`:
```php
private static $password = 'sua_senha';
```

## 🐛 Problemas Comuns

| Problema | Solução |
|----------|---------|
| Página não encontrada | Verificar se Apache está rodando |
| Erro de conexão | Verificar se MySQL está rodando |
| CSS não carrega | Verificar URL base em `index.php` |
| Imagens não aparecem | Verificar pasta `public/img/` |

## 📞 Suporte

Consulte os arquivos de documentação:
- `README.md` - Guia completo
- `INSTALACAO.md` - Instalação passo a passo
- `DOCUMENTACAO_TECNICA.md` - Detalhes técnicos

---

**Versão:** 1.0.0  
**Última atualização:** 2024

