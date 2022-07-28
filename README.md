## App Laravel

##### Para testar o projeto, execute os seguintes comandos:

__Criar o arquivo .env a partir do .env.example__

__Subir os containers do Docker:__

    docker-compose up -d --build

__Listar os containers:__

    docker ps

Aparecerão os seguintes containers 'app-property', 'property-nginx', 'property-mysql'.

__Acessar o container da aplicação:__

    docker exec -it test-app sh

__Executar os seguintes comandos__

    composer install
    php artisan key:generate
    php artisan migrate:fresh --seed
    php artisan test

__Acessar o projeto no navegador__

    http://localhost:8989/
