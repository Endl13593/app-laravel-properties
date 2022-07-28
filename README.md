## Laravel Test Backend

##### Para testar o projeto, execute os seguintes comandos:

__Subir os containers do Docker:__

    docker-compose up -d --build

__Listar os containers:__

    docker ps

Aparecerão os seguintes containers 'test-app', 'test-mysql'.

__Criar o arquivo .env a partir do .env.example__

Configurar as variaveis de ambiente abaixo, para o funcionamento do disparo de email através de jobs, foi usado pra teste o mailtrap

    QUEUE_CONNECTION=database
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=
    MAIL_FROM_NAME="${APP_NAME}"

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