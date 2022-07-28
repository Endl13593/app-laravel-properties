## App Laravel

##### Para testar o projeto, execute os seguintes comandos:

__Subir os containers do Docker:__

    docker-compose up -d --build

__Listar os containers:__

    docker ps

Aparecerão os seguintes containers 'test-app', 'test-mysql'.

__Criar o arquivo .env a partir do .env.example__

__Acessar o container da aplicação:__

    docker exec -it test-app sh

__Executar os seguintes comandos__

    composer install
    php artisan key:generate

__Descer os containers__
    
    docker-compose down

__Subir novamente os containers atualizados__

    docker-compose up -d

__Listar novamente os containers:__

    docker ps

Dessa vez aparecerão os seguintes containers 'test-app', 'test-mysql', 'test-app-queue'.

__Acessar o container da aplicação:__

    docker exec -it test-app sh

__Executar os seguintes comandos__

    php artisan migrate:fresh --seed
    php artisan test

__Acessar o projeto no navegador__

    http://localhost
