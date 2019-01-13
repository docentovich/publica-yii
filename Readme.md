    cd /C/Users/docen/prj/publica-yii

start :
======

1. set chmod:

    > $ chmod +x  run_nginx.sh
    
2. create .env file from .env.{..}.demo
    
3. up:

   > $ docker-compose -f docker-dev.yml up -d    
   > $ docker-compose -f docker-prod.yml up -d
	
4. enter container:

   > $ docker exec -ti publicayii_php_1 /bin/sh
    
5. init app:

   > $ composer install     
   > $ php init     
   > $ composer dump-autoload   
   > $ php yii migrate up   
   > $ php yii migrate up --migrationPath=@yii/rbac/migrations  
    
6. init rbac:

   > $ php yii migrate --migrationPath=@yii/rbac/migrations     
   > $ php yii rbac/init

else
=====   

commands:

    $ php yii migrate/down 1 --migrationPath=src/migrations
    $ php yii migrate/down all --migrationPath=src/migrations
    $ php yii migrate/create <name> --migrationPath=src/migrations
    $ php yii migrate/create add_index --migrationPath=src/migrations
    
###### notes:

> docker-compose exec mysql bash error:  https://github.com/laradock/laradock/issues/1173