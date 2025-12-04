# 🚀 Guia Rápido de Instalação

Este guia fornece os passos essenciais para executar o projeto rapidamente.

## ⚡ Instalação Rápida (5 minutos)

### 1️⃣ Pré-requisitos
- ✅ XAMPP instalado
- ✅ Navegador web

### 2️⃣ Colocar o Projeto no Lugar Certo

```
C:\xampp\htdocs\Cupons_Turismo\
```

### 3️⃣ Iniciar Servidores

1. Abra **XAMPP Control Panel**
2. Clique em **Start** em:
   - Apache
   - MySQL

### 4️⃣ Criar o Banco de Dados

1. Abra: `http://localhost/phpmyadmin`
2. Clique em **Importar**
3. Selecione: `SQL/estruturas.sql`
4. Clique em **Executar**

### 5️⃣ Acessar o Sistema

Abra no navegador:
```
http://localhost/Cupons_Turismo/
```

### 6️⃣ Criar Conta e Tornar-se Admin

1. **Cadastre-se** no sistema
2. No phpMyAdmin, execute:
   ```sql
   UPDATE usuarios SET nivel = 'admin' WHERE email = 'seu_email@aqui.com';
   ```
3. **Faça logout e login novamente**

## ✅ Pronto!

Agora você pode:
- ✅ Ver cupons na home
- ✅ Resgatar cupons (como usuário)
- ✅ Criar ofertas (como empresa)
- ✅ Gerenciar tudo (como admin)

## 🔧 Configurações Opcionais

### Se o projeto estiver em outro caminho:

Edite `index.php` linha 6:
```php
define('BASE_URL', 'http://localhost/SEU_CAMINHO/public/');
```

### Se o MySQL tiver senha:

Edite `app/Models/Database.php`:
```php
private static $password = 'sua_senha';
```

---

**Dúvidas?** Consulte o `README.md` completo.

