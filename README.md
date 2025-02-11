### Instalação

```
https://github.com/maaiconantonio/docker-lara-app.git

cd system

cp .env.example .env
```

#### Criar os containers e subir o ambiente:

```
docker-compose build
docker-compose up -d
```

<p><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p>
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

#### Sobre a Instalação do Laravel:
Acesse o container app:
```
docker-compose exec app bash
```

Instale as dependências do projeto:
```
composer install
```
Gere uma key do projeto Laravel:
```
php artisan key:generate
```
Rode as migrations:
```
php artisan migrate
```
O projeto estará online:
<a href="http://localhost:8000">http://localhost:8000</a>

#### Ambiente:

###### A collection está na raiz:
```
Cake Collection.postman_collection.json
```
Para executar os testes e a fila pode usar o artisan

Foram criadas as rotas do CRUD do bolo

Também 2 adicionais para gravar os usuários interessados e removê-los depois do email enviado

Foi criado um front que pode ser acessado através do navegador na url principal para gravar usuários mas não funcionou o bootstrap =(