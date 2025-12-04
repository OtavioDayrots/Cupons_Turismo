# 🎫 Sistema de Cupons de Turismo

Sistema web desenvolvido em PHP para gerenciamento de cupons de desconto para estabelecimentos turísticos. Permite que usuários resgatem cupons, empresas criem ofertas e administradores gerenciem todo o sistema.

## 📋 Índice

- [Requisitos](#-requisitos)
- [Instalação](#-instalação)
- [Configuração do Banco de Dados](#-configuração-do-banco-de-dados)
- [Configuração do Projeto](#-configuração-do-projeto)
- [Executando o Projeto](#-executando-o-projeto)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Funcionalidades](#-funcionalidades)
- [Níveis de Acesso](#-níveis-de-acesso)
- [Credenciais de Teste](#-credenciais-de-teste)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)

## 🛠 Requisitos

Antes de começar, certifique-se de ter instalado:

- **XAMPP** (versão 7.4 ou superior) ou servidor web com PHP 7.4+
- **MySQL/MariaDB** (incluído no XAMPP)
- **Navegador web moderno** (Chrome, Firefox, Edge, etc.)

### Verificação dos Requisitos

1. **PHP**: Abra o terminal/CMD e execute:
   ```bash
   php -v
   ```
   Deve mostrar a versão do PHP (7.4 ou superior).

2. **MySQL**: Verifique se o MySQL está rodando no XAMPP Control Panel.

## 📦 Instalação

### Passo 1: Clonar/Baixar o Projeto

1. Baixe o projeto e extraia na pasta `htdocs` do XAMPP:
   ```
   C:\xampp\htdocs\Cupons_Turismo
   ```

   Ou se preferir outro local, ajuste a URL base no arquivo `main.php`.

### Passo 2: Iniciar Servidores

1. Abra o **XAMPP Control Panel**
2. Inicie os serviços:
   - ✅ **Apache** (servidor web)
   - ✅ **MySQL** (banco de dados)

### Passo 3: Verificar Permissões

Certifique-se de que a pasta do projeto tem permissões de leitura/escrita.

## 🗄 Configuração do Banco de Dados

### Passo 1: Criar o Banco de Dados

1. Abra o **phpMyAdmin**:
   - Acesse: `http://localhost/phpmyadmin`
   - Ou clique em "Admin" ao lado de MySQL no XAMPP Control Panel

2. Importe o arquivo SQL:
   - Clique em "Importar" no menu superior
   - Selecione o arquivo: `SQL/estruturas.sql`
   - Clique em "Executar"

   **OU** execute manualmente:

   ```sql
   -- Copie e cole todo o conteúdo do arquivo SQL/estruturas.sql
   -- no console SQL do phpMyAdmin
   ```

### Passo 2: Verificar Configuração do Banco

O arquivo `app/Models/Database.php` já está configurado com as credenciais padrão do XAMPP:

```php
host: localhost
database: cupons-turismo
username: root
password: (vazio)
```

**Se você usar outras credenciais**, edite o arquivo `app/Models/Database.php`:

```php
private static $host = 'localhost';
private static $db_name = 'cupons-turismo';
private static $username = 'seu_usuario';
private static $password = 'sua_senha';
```

### Passo 3: Criar Usuário Administrador

Após criar o banco, você precisa criar um usuário administrador:

1. Acesse o sistema e **cadastre-se** normalmente
2. No phpMyAdmin, execute:

```sql
-- Substitua 'seu_email@exemplo.com' pelo email que você cadastrou
UPDATE usuarios SET nivel = 'admin' WHERE email = 'seu_email@exemplo.com';
```

## ⚙️ Configuração do Projeto

### Ajustar URL Base (se necessário)

Se você instalou o projeto em um caminho diferente, edite o arquivo `main.php`:

```php
// Linha 6
define('BASE_URL', 'http://localhost/Cupons_Turismo/public/');
```

**Exemplos:**
- Se estiver em `htdocs/meu_projeto`: `http://localhost/meu_projeto/public/`
- Se usar porta diferente: `http://localhost:8080/Cupons_Turismo/public/`

### Verificar Estrutura de Pastas

Certifique-se de que a estrutura está assim:

```
Cupons_Turismo/
├── app/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── public/
│   ├── css/
│   └── img/
├── SQL/
├── main.php
├── .htaccess
└── README.md
```

## 🚀 Executando o Projeto

### Passo 1: Iniciar Servidores

1. Abra o **XAMPP Control Panel**
2. Inicie **Apache** e **MySQL**

### Passo 2: Acessar o Sistema

Abra seu navegador e acesse:

```
http://localhost/Cupons_Turismo/
```

ou

```
http://localhost/Cupons_Turismo/main.php
```

### Passo 3: Primeiro Acesso

1. **Cadastre-se** como usuário comum
2. **Faça login** com suas credenciais
3. **Torne-se admin** (veja seção "Criar Usuário Administrador" acima)

## 📁 Estrutura do Projeto

```
Cupons_Turismo/
│
├── app/                          # Código da aplicação
│   ├── Controllers/              # Controladores (lógica de negócio)
│   │   ├── AdminController.php   # Gerenciamento administrativo
│   │   ├── EmpresaController.php # Painel da empresa
│   │   ├── HomeController.php    # Página inicial
│   │   └── UserController.php    # Autenticação e cupons
│   │
│   ├── Models/                   # Modelos (acesso ao banco)
│   │   ├── Cupom.php              # Modelo de cupons
│   │   ├── Database.php           # Conexão com banco
│   │   ├── Resgate.php            # Modelo de resgates
│   │   └── Usuario.php            # Modelo de usuários
│   │
│   └── Views/                     # Templates (interface)
│       ├── admin_*.php            # Páginas administrativas
│       ├── empresa_painel.php    # Painel da empresa
│       ├── home.php               # Página inicial
│       ├── login.php              # Login
│       ├── cadastro.php           # Cadastro
│       └── meus_cupons.php        # Cupons resgatados
│
├── public/                        # Arquivos públicos
│   ├── css/                       # Estilos CSS
│   │   ├── global.css            # CSS principal
│   │   ├── admin.css             # Estilos admin
│   │   ├── home.css              # Estilos home
│   │   └── ...
│   │
│   ├── img/                       # Imagens
│   │   └── *.png, *.jpg
│   │
│   └── index.php                  # Arquivo de roteamento alternativo
│
├── SQL/                           # Scripts SQL
│   └── estruturas.sql            # Estrutura do banco
│
├── main.php                       # Ponto de entrada principal
├── .htaccess                      # Configuração Apache
└── README.md                      # Esta documentação
```

## ✨ Funcionalidades

### 👤 Usuário Comum
- ✅ Cadastro e login
- ✅ Visualizar cupons disponíveis
- ✅ Resgatar cupons
- ✅ Ver cupons resgatados com QR Code
- ✅ Visualizar código único do cupom

### 🏢 Empresa
- ✅ Criar ofertas de cupons
- ✅ Gerenciar estoque de cupons
- ✅ Visualizar cupons criados
- ✅ Excluir ofertas

### 👨‍💼 Administrador
- ✅ Gerenciar todos os cupons
- ✅ Criar, editar e excluir cupons
- ✅ Gerenciar usuários
- ✅ Alterar níveis de acesso (admin/empresa/usuário)
- ✅ Visualizar todas as ofertas

## 🔐 Níveis de Acesso

O sistema possui três níveis de acesso:

1. **usuario** (padrão)
   - Acesso básico ao sistema
   - Pode resgatar cupons

2. **empresa**
   - Pode criar e gerenciar ofertas
   - Acesso ao painel da empresa

3. **admin**
   - Acesso total ao sistema
   - Pode gerenciar usuários e cupons

### Como Alterar Nível de Acesso

No phpMyAdmin, execute:

```sql
-- Tornar usuário em admin
UPDATE usuarios SET nivel = 'admin' WHERE email = 'email@exemplo.com';

-- Tornar usuário em empresa
UPDATE usuarios SET nivel = 'empresa' WHERE email = 'email@exemplo.com';

-- Voltar para usuário comum
UPDATE usuarios SET nivel = 'usuario' WHERE email = 'email@exemplo.com';
```

## 🧪 Credenciais de Teste

Após criar o banco de dados, você pode criar usuários de teste:

### Criar Usuário Admin via SQL

```sql
-- Inserir usuário admin diretamente
INSERT INTO usuarios (nome, email, senha, nivel) 
VALUES ('Admin Teste', 'admin@teste.com', MD5('123456'), 'admin');
```

**Login:**
- Email: `admin@teste.com`
- Senha: `123456`

### Criar Usuário Empresa via SQL

```sql
-- Inserir usuário empresa
INSERT INTO usuarios (nome, email, senha, nivel) 
VALUES ('Empresa Teste', 'empresa@teste.com', MD5('123456'), 'empresa');
```

**Login:**
- Email: `empresa@teste.com`
- Senha: `123456`

> **⚠️ IMPORTANTE:** Em produção, use hash seguro (password_hash) ao invés de MD5.

## 🛠 Tecnologias Utilizadas

- **Backend:**
  - PHP 7.4+
  - MySQL/MariaDB
  - PDO (PHP Data Objects)

- **Frontend:**
  - HTML5
  - CSS3 (com gradientes e animações)
  - JavaScript (vanilla)
  - Font Awesome (ícones)

- **Arquitetura:**
  - MVC (Model-View-Controller)
  - Roteamento manual via switch/case

## 📝 Notas Importantes

### Segurança
- ⚠️ Este é um projeto acadêmico/demonstração
- ⚠️ Em produção, implemente:
  - Hash seguro para senhas (password_hash)
  - Validação de entrada mais rigorosa
  - Proteção contra SQL Injection (já usa PDO preparado)
  - CSRF tokens
  - Sanitização de dados

### Banco de Dados
- O banco é criado automaticamente pelo script SQL
- Dados de exemplo são inseridos automaticamente
- Ajuste as credenciais em `app/Models/Database.php` se necessário

### URL Base
- A URL base está configurada para `http://localhost/Cupons_Turismo/public/`
- Se usar outro caminho, ajuste em `main.php` linha 6

## 🐛 Solução de Problemas

### Erro: "Página não encontrada"
- ✅ Verifique se o Apache está rodando
- ✅ Confirme que o arquivo está em `htdocs/Cupons_Turismo/`
- ✅ Verifique a URL no navegador

### Erro: "Erro na conexão"
- ✅ Verifique se o MySQL está rodando
- ✅ Confirme as credenciais em `app/Models/Database.php`
- ✅ Verifique se o banco `cupons-turismo` existe

### Erro: "Página em branco"
- ✅ Ative exibição de erros no PHP (php.ini)
- ✅ Verifique os logs do Apache
- ✅ Confirme que todas as pastas existem

### CSS não carrega
- ✅ Verifique se a URL base está correta em `main.php`
- ✅ Confirme que a pasta `public/css/` existe
- ✅ Limpe o cache do navegador (Ctrl+F5)

### Imagens não aparecem
- ✅ Verifique se a pasta `public/img/` existe
- ✅ Confirme os caminhos das imagens nas views
- ✅ Verifique permissões da pasta

## 📞 Suporte

Para dúvidas ou problemas:

1. Verifique esta documentação
2. Revise os logs do Apache/MySQL
3. Confirme que todos os requisitos estão instalados

## 📄 Licença

Este projeto foi desenvolvido para fins acadêmicos/educacionais.

---

**Desenvolvido com ❤️ para gerenciamento de cupons turísticos**
