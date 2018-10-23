composer start :

	$ cd ~/docker/publica && docker-compose -f docker-compose.yml -f docker-compose-win-dev.yml up
	$ docker-compose -f docker-compose.yml -f docker-compose-win-dev.yml up
	$ docker-compose -f docker-compose.yml -f docker-compose-mac-dev.yml up
	$ docker-compose -f docker-compose.yml -f docker-compose-win-prod.yml up
	$ docker-compose -f docker-compose.yml -f docker-compose-mac-prod.yml up
	
	$ DBG_IP=192.168.56.1 docker-compose -f docker-dev.yml up -d
    $ docker exec -ti publicayii_php_1 /bin/sh
    $ php yii migrate up --migrationPath=src/migrations
notes:

> docker-compose exec mysql bash error:  https://github.com/laradock/laradock/issues/1173