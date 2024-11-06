# JOTA News API

API para gerenciamento de usuários, notícias e comentários. Essa aplicação foi desenvolvida usando Laravel e requer autenticação via token.

## Sumário
- [Requisitos](#requisitos)
- [Instalação e Configuração](#instalação-e-configuração)
- [Rodando a API](#rodando-a-api)
- [Rotas da API](#rotas-da-api)
  - [Autenticação](#autenticação)
  - [Notícias](#notícias)
  - [Comentários](#comentários)
- [Testando com Postman](#testando-com-postman)
- [Considerações Finais](#considerações-finais)

## Requisitos
- PHP 7.4 ou superior
- Composer
- MySQL ou outro banco de dados compatível
- Postman (opcional, para testes)

## Instalação e Configuração
1. Clone o repositório:
   ```bash
   git clone https://github.com/seu_usuario/seu_repositorio.git
   cd seu_repositorio


2. Instale as dependências do PHP:
composer install

3. Copie o arquivo de configuração .env:
cp .env.example .env

4. Abra o arquivo .env e configure as variáveis do banco de dados:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jota_news
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

5. Gere a chave da aplicação:
php artisan key:generate

6. Crie as tabelas no banco de dados usando as migrations:
php artisan migrate

7. inicia o servidor laravel
php artisan serve

A API estará disponível em http://127.0.0.1:8000.

Rotas da API
Autenticação
POST /api/register: Registra um novo usuário. Requisição: { "name": "Seu Nome", "email": "seu_email@example.com", "password": "sua_senha", "role": "user" }

POST /api/login: Realiza login e retorna um token de autenticação. Requisição: { "email": "seu_email@example.com", "password": "sua_senha" }

POST /api/logout: Desloga o usuário autenticado.

Notícias
GET /api/news: Lista todas as notícias.
GET /api/news/{id}: Obtém uma notícia específica.
POST /api/news: Cria uma nova notícia. Requisição: { "title": "Título", "content": "Conteúdo da notícia" }
PUT /api/news/{id}: Atualiza uma notícia existente. Requisição: { "title": "Título atualizado", "content": "Conteúdo atualizado" }
DELETE /api/news/{id}: Remove uma notícia.

Comentários
POST /api/news/{newsId}/comments: Adiciona um comentário a uma notícia. Requisição: { "content": "Conteúdo do comentário" }
GET /api/news/{newsId}/comments: Lista todos os comentários de uma notícia.
PUT /api/comments/{id}: Atualiza um comentário. Requisição: { "content": "Conteúdo atualizado do comentário" }
DELETE /api/comments/{id}: Remove um comentário.

Testando com Postman
Abra o Postman e configure as requisições conforme as rotas listadas acima.
Para registrar um usuário, selecione POST, insira a URL http://127.0.0.1:8000/api/register e adicione o corpo JSON conforme mencionado.
Para realizar login, faça o mesmo, utilizando a URL http://127.0.0.1:8000/api/login.
Teste as demais rotas utilizando o token obtido no login para autenticação.