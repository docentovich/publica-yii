###### composer start :

    cd /C/Users/docen/prj/publica-yii

toolbox:

	$ DBG_IP=192.168.99.1 docker-compose -f docker-dev.yml up -d
	
native: 

	$ SET DBG_IP=10.0.75.1 && docker-compose -f docker-dev.yml up -d
	
stop:

	$ docker-compose -f docker-dev.yml down
enter container:

    $ docker exec -ti publica-yii_php_1 /bin/sh
init app:

    $ composer install
    $ php yii init
    $ composer dump-autoload
    $ php yii migrate up --migrationPath=src/migrations
    $ php yii migrate up --migrationPath=src/migrations && php yii migrate --migrationPath=@yii/rbac/migrations
    
    
init rbac:

    $ php yii migrate --migrationPath=@yii/rbac/migrations
    $ php yii rbac/init
    
else commands:

    $ php yii migrate/down 1 --migrationPath=src/migrations
    $ php yii migrate/down all --migrationPath=src/migrations
    $ php yii migrate/create <name> --migrationPath=src/migrations
    
    
###### notes:

> docker-compose exec mysql bash error:  https://github.com/laradock/laradock/issues/1173