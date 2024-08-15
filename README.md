# Product Management API with Laravel

Uma API de gerenciamento de estoque de produtos, feita para o contexto onde existem funcionários que devem gerenciar os produtos, e administradores que devem gerenciar os produtos e os funcionários.

## 🍃 Tecnologias utilizadas
Para criar está solução, foi utilizado as seguintes tecnologias:

- Laravel Framework (v10.10)
- PHP (v8.1.10)
- PostgreSQL (v15.6.1.100)

## 🛠️ Funcionalidades
Principais recursos do sistema:

- Gerenciamento de produtos (CRUD);
- Gerenciamento de categorias (CRUD);
- Gerenciamento de usuários (CRUD);
- Login e Logout (autenticação JWT);
- Restrição de acesso ao gerenciamento de usuários (role no Token JWT), exclusivo para usuários "admin".

## ✉️ Comunicação com a API
### URL da API
- https://product-management-api-with-laravel.onrender.com
### Login
(☑️ rota livre)
- POST: "api/login" - Login com body de [LoginAuthRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests), e devolução de Token JWT.

(🔒 rota com JWT)
- POST: "api/logout" - Logout com Token JWT no HEAD.
### Usuários (🔒 Controller com JWT e 🤵🏻 restrição para "admin")
- GET: "api/user" - Todos os usuários.
- GET: "api/user/{id}" - Um usuário baseado no Id.
- POST: "api/user" - Cria um usuário com body de [StoreUserRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests/StoreUserRequest.php).
- PUT: "api/user/{id}" - Atualiza um usuário com body de [UpdateUserRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests/UpdateUserRequest.php).
- DELETE: "api/user/{id}" - Exclui um usuário baseado no Id.
### Produtos (🔒 Controller com JWT)
- GET: "api/product" - Todos os produtos.
- GET: "api/product/{id}" - Um produto baseado no Id.
- POST: "api/product" - Cria um produto com body de [StoreProductRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests/StoreProductRequest.php).
- PUT: "api/product/{id}" - Atualiza um produto com body de [UpdateProductRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests/UpdateProductRequest.php).
- DELETE: "api/product/{id}" - Exclui um produto baseado no Id.
### Categoria (🔒 Controller com JWT)
- GET: "api/category" - Todas as categorias.
- GET: "api//category/{id}" - Uma categoria baseada no Id.
- POST: "api//category" - Cria uma categoria com body de [StoreCategoryRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests/StoreCategoryRequest.php).
- PUT: "api//category/{id}" - Atualiza uma categoria com body de [StoreCategoryRequest](https://github.com/WesleyTelesBenette/product-management-api-with-laravel/tree/master/app/Http/Requests/StoreCategoryRequest.php).
- DELETE: "api//category/{id}" - Exclui uma categoria baseada no Id.

## 🚀 Como Contribuir?

### Quando Contribuir?
- Quando você encontrar um bug ou uma falha.
- Quando achar que há alguma funcionalidade essencial que está faltando no sistema.
- Quando achar que alguma pequena funcionalidade ou ajuste possa agregar para o sistema de alguma forma.

### Commit
- Crie uma nova Branch para subir suas alterações, de preferência com o prefixo "pmal-contribution":
```bash
git checkout -b pmal-contribution-namebranch master
```

