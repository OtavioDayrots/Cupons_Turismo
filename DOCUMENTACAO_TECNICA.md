# 📚 Documentação Técnica - Sistema de Cupons de Turismo

## 🏗 Arquitetura do Sistema

### Padrão MVC (Model-View-Controller)

```
┌─────────────┐
│   Browser   │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  main.php   │ ← Roteamento
└──────┬──────┘
       │
       ├──► Controllers/  ← Lógica de Negócio
       │         │
       │         ├──► Models/  ← Acesso ao Banco
       │         │
       │         └──► Views/  ← Interface (HTML)
       │
       └──► Database (MySQL)
```

## 📊 Estrutura do Banco de Dados

### Tabela: `usuarios`
```sql
- id (INT, PK, AUTO_INCREMENT)
- nome (VARCHAR 100)
- email (VARCHAR 100, UNIQUE)
- senha (VARCHAR 255)
- nivel (VARCHAR 20) - 'usuario', 'empresa', 'admin'
- criado_em (TIMESTAMP)
```

### Tabela: `cupons`
```sql
- id (INT, PK, AUTO_INCREMENT)
- nome (VARCHAR 100)
- imagem (VARCHAR 255)
- quantidade (INT)
- desconto (VARCHAR 20)
- usuario_id (INT, FK) - Dono do cupom (empresa)
```

### Tabela: `resgates`
```sql
- id (INT, PK, AUTO_INCREMENT)
- usuario_id (INT, FK) - Quem resgatou
- cupom_id (INT, FK) - Cupom resgatado
- codigo_unico (VARCHAR 50) - Código único do cupom
- data_resgate (TIMESTAMP)
```

## 🔄 Fluxo de Requisições

### 1. Acesso à Home
```
Browser → main.php?page=home
       → HomeController::index()
       → Cupom::listarTodos()
       → View: home.php
```

### 2. Resgate de Cupom
```
Browser → main.php?page=resgatar&id=X
       → UserController::resgatar()
       → Verifica estoque
       → Gera código único
       → Resgate::criar()
       → Redireciona para meus-cupons
```

### 3. Login
```
Browser → main.php?page=fazer-login
       → UserController::autenticar()
       → Usuario::logar()
       → Cria sessão
       → Redireciona para home
```

## 🔐 Sistema de Autenticação

### Sessões PHP
O sistema usa sessões nativas do PHP para autenticação:

```php
// Iniciar sessão (em main.php)
session_start();

// Salvar dados do usuário
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_email'] = $usuario['email'];
$_SESSION['usuario_nivel'] = $usuario['nivel'];

// Verificar login
if (isset($_SESSION['usuario_id'])) {
    // Usuário logado
}

// Logout
session_destroy();
```

### Proteção de Rotas
As rotas protegidas verificam a sessão:

```php
// Exemplo em UserController::resgatar()
if (!isset($_SESSION['usuario_id'])) {
    header('Location: main.php?page=login');
    exit;
}
```

## 🎨 Sistema de Roteamento

### Roteamento Manual (Switch/Case)

O arquivo `main.php` contém todas as rotas:

```php
$pagina = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($pagina) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    // ... outras rotas
}
```

### Rotas Disponíveis

| Rota | Controller | Método | Descrição |
|------|-----------|--------|-----------|
| `home` | HomeController | index() | Página inicial |
| `login` | UserController | login() | Formulário de login |
| `fazer-login` | UserController | autenticar() | Processa login |
| `cadastro` | UserController | create() | Formulário de cadastro |
| `salvar-usuario` | UserController | store() | Processa cadastro |
| `logout` | UserController | logout() | Encerra sessão |
| `meus-cupons` | UserController | painel() | Cupons resgatados |
| `resgatar` | UserController | resgatar() | Resgata cupom |
| `admin` | AdminController | index() | Painel admin |
| `admin-store` | AdminController | store() | Cria cupom (admin) |
| `admin-edit` | AdminController | edit() | Edita cupom |
| `admin-update` | AdminController | update() | Atualiza cupom |
| `admin-delete` | AdminController | delete() | Exclui cupom |
| `admin-users` | AdminController | usuarios() | Lista usuários |
| `empresa-painel` | EmpresaController | index() | Painel empresa |
| `empresa-store` | EmpresaController | store() | Cria oferta |
| `empresa-delete` | EmpresaController | delete() | Exclui oferta |

## 🗂 Organização de Arquivos

### Controllers (Lógica de Negócio)

**HomeController.php**
- `index()` - Lista todos os cupons

**UserController.php**
- `create()` - Mostra formulário de cadastro
- `store()` - Salva novo usuário
- `login()` - Mostra formulário de login
- `autenticar()` - Valida credenciais
- `logout()` - Encerra sessão
- `painel()` - Mostra cupons resgatados
- `resgatar()` - Processa resgate de cupom

**AdminController.php**
- `index()` - Lista todos os cupons
- `store()` - Cria cupom
- `edit()` - Mostra formulário de edição
- `update()` - Atualiza cupom
- `delete()` - Exclui cupom
- `usuarios()` - Lista usuários
- `editUser()` - Edita usuário
- `updateUser()` - Atualiza usuário
- `deleteUser()` - Exclui usuário

**EmpresaController.php**
- `index()` - Lista cupons da empresa
- `store()` - Cria oferta
- `delete()` - Exclui oferta

### Models (Acesso ao Banco)

**Database.php**
- Classe singleton para conexão PDO
- Método estático `conectar()`

**Usuario.php**
- `cadastrar($nome, $email, $senha)` - Cria usuário
- `logar($email, $senha)` - Autentica usuário
- `buscarPorId($id)` - Busca usuário por ID

**Cupom.php**
- `listarTodos()` - Lista todos os cupons
- `buscarPorId($id)` - Busca cupom por ID
- `criar($dados)` - Cria novo cupom
- `atualizar($id, $dados)` - Atualiza cupom
- `excluir($id)` - Exclui cupom
- `listarPorEmpresa($usuario_id)` - Lista cupons da empresa
- `diminuirEstoque($id)` - Reduz quantidade

**Resgate.php**
- `criar($usuario_id, $cupom_id, $codigo)` - Cria resgate
- `listarPorUsuario($usuario_id)` - Lista resgates do usuário
- `verificarResgate($usuario_id, $cupom_id)` - Verifica se já resgatou

### Views (Interface)

Todas as views estão em `app/Views/` e seguem o padrão:
- HTML5 semântico
- CSS via arquivos externos
- PHP para dados dinâmicos
- Font Awesome para ícones

## 🎨 Sistema de Estilos

### Arquitetura CSS

```
global.css (importa todos)
├── style.css (estilos base)
├── admin.css (páginas admin)
├── home.css (página inicial)
├── meus_cupons.css (cupons resgatados)
├── empresa.css (painel empresa)
└── auth.css (login/cadastro)
```

### Variáveis e Padrões

**Cores Principais:**
- Verde: `#228B22` (primária)
- Verde claro: `#32CD32` (secundária)
- Vermelho: `#e74c3c` (erro/esgotado)
- Azul: `#3498db` (links)
- Cinza escuro: `#2c3e50` (texto)

**Gradientes:**
- Header: `linear-gradient(135deg, #228B22 0%, #32CD32 100%)`
- Botões: Gradientes suaves para efeito moderno

## 🔒 Segurança

### Implementado
- ✅ PDO Prepared Statements (proteção SQL Injection)
- ✅ Validação de sessão
- ✅ Verificação de estoque antes de resgate
- ✅ Verificação de duplicidade de resgate

### Recomendações para Produção
- ⚠️ Usar `password_hash()` ao invés de MD5
- ⚠️ Implementar CSRF tokens
- ⚠️ Sanitizar todas as entradas
- ⚠️ Validar tipos de arquivo (imagens)
- ⚠️ Limitar tentativas de login
- ⚠️ HTTPS obrigatório

## 📱 Responsividade

O sistema é responsivo e se adapta a:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (< 768px)

Breakpoints principais:
```css
@media (max-width: 768px) {
    /* Estilos mobile */
}
```

## 🧪 Testes Recomendados

### Funcionalidades a Testar

1. **Autenticação**
   - [ ] Cadastro de novo usuário
   - [ ] Login com credenciais válidas
   - [ ] Login com credenciais inválidas
   - [ ] Logout

2. **Cupons**
   - [ ] Visualizar lista de cupons
   - [ ] Resgatar cupom disponível
   - [ ] Tentar resgatar cupom esgotado
   - [ ] Ver cupons resgatados
   - [ ] Verificar QR Code gerado

3. **Empresa**
   - [ ] Criar oferta
   - [ ] Editar oferta
   - [ ] Excluir oferta
   - [ ] Verificar estoque

4. **Admin**
   - [ ] Criar cupom
   - [ ] Editar cupom
   - [ ] Excluir cupom
   - [ ] Gerenciar usuários
   - [ ] Alterar níveis de acesso

## 🐛 Debug e Logs

### Ativar Exibição de Erros

No `main.php`, adicione no início:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Logs do Apache

Localização (XAMPP):
```
C:\xampp\apache\logs\error.log
```

### Logs do MySQL

Localização (XAMPP):
```
C:\xampp\mysql\data\mysql_error.log
```

## 📈 Melhorias Futuras

- [ ] API REST
- [ ] Sistema de notificações
- [ ] Relatórios e estatísticas
- [ ] Upload de imagens
- [ ] Validação de cupons por QR Code
- [ ] Sistema de avaliações
- [ ] Filtros e busca avançada
- [ ] Paginação
- [ ] Cache de consultas
- [ ] Testes automatizados

## 📝 Notas de Desenvolvimento

### Convenções de Código
- Nomes de classes: PascalCase (`UserController`)
- Nomes de métodos: camelCase (`listarTodos`)
- Nomes de variáveis: camelCase (`$usuarioId`)
- Indentação: 4 espaços

### Estrutura de Commits (se usar Git)
```
feat: adiciona funcionalidade X
fix: corrige bug Y
docs: atualiza documentação
style: ajusta formatação
refactor: refatora código
```

---

**Última atualização:** 2024
**Versão:** 1.0.0

