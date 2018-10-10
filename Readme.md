composer start :

	cd ~/docker/publica && docker-compose -f docker-compose.yml -f docker-compose-win-dev.yml up
	docker-compose -f docker-compose.yml -f docker-compose-win-dev.yml up
	docker-compose -f docker-compose.yml -f docker-compose-mac-dev.yml up
	docker-compose -f docker-compose.yml -f docker-compose-win-prod.yml up
	docker-compose -f docker-compose.yml -f docker-compose-mac-prod.yml up
	
notes:

> docker-compose exec mysql bash error:  https://github.com/laradock/laradock/issues/1173