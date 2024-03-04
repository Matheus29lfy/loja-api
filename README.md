### Pré requisitos-

 Download and Instale [Docker](https://docs.docker.com/engine/install/)

 ### Clone esse template para seu projeto

 - git clone https://github.com/Matheus29lfy/loja-api.git

 ## Rode App Manualmente
 - Crie um arquivo .env para o ambiente Laravel a partir do .env.example na pasta src.
 - Execute o comando docker-compose build no seu terminal.
 - Execute o comando docker-compose up -d no seu terminal.
 - Execute o comando docker-compose -f docker-compose.yml -f docker-compose.testing.yml up -d no seu terminal para configurar o ambiente de testing.  
 - Execute o comando docker exec -it php /bin/sh no seu terminal.
 - Execute o comando chmod -R 777 storage no seu terminal após acessar o contêiner PHP no Docker.
- Execute o comando composer install no seu terminal após acessar o contêiner PHP no Docker.
 - Se a chave app:key ainda estiver vazia no .env, execute php artisan key:generate no seu terminal após acessar o contêiner PHP no Docker.
 - Para executar comandos artisan, como migrate, etc., vá para o contêiner PHP usando docker exec -it php /bin/sh.
 - Acesse http://localhost:8001 ou a porta que você definiu para abrir o Laravel.

 Nota: Se você encontrar um erro de permissão ao executar o Docker, tente executá-lo como administrador ou use sudo no Linux.

 Observação: .env e .env.testing na configuração há uma configuração do mysql_host=mysql, deve ser mantido assim para que o docker possa encontrar a porta padrão local por causa das config