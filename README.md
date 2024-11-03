# Instruções para instalação da aplicação

Este arquivo contém as instruções necessárias para instalar e configurar a aplicação.

## Pré-requisitos

Antes de começar, você precisará ter os seguintes itens instalados em sua máquina:

1. **PHP**: A versão recomendada é 8.0 ou superior.
2. **Composer**: O gerenciador de dependências para PHP.
3. **Servidor Web**: Apache, Nginx ou outro servidor que suporte PHP.
4. **Banco de Dados**: MySQL, PostgreSQL, SQLite ou outro banco de dados suportado.

## Passos para Instalação

### 1. Clone o Repositório

Clone o repositório da aplicação usando o seguinte comando:

`git clone https://github.com/jessidias/fiap.git


### 2. Navegue até o Diretório do Projeto

`cd fiap`

### 3. Instale as Dependências

Use o Composer para instalar as dependências do projeto:
`composer install`

### 4. Copie o Arquivo .env

Copie o arquivo de exemplo .env.example para .env:
`cp .env.example .env`

### 5. Configure as Variáveis de Ambiente

Abra o arquivo .env em um editor de texto e configure as variáveis de ambiente, especialmente as relacionadas ao banco de dados:
`DB_CONNECTION=mysql
`DB_HOST=127.0.0.1
`DB_PORT=3306
`DB_DATABASE=fiap
`DB_USERNAME=root
`DB_PASSWORD=

### 6. Gere a Chave da Aplicação

Execute o comando abaixo para gerar a chave da aplicação:
`php artisan key:generate`

### 7. Execute as Migrações

Execute o comando abaixo para criar as tabelas:
`php artisan migrate`

### 8. Inicie o Servidor

Inicie o servidor do Laravel:
`php artisan serve`