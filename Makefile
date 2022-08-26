du: memory
	docker compose up -d

dd:
	docker compose down

db: memory
	docker compose up --build -d

d-install: db composer-install

de:
	docker exec -it optimacros-php sh

composer-install:
	docker compose exec php-fpm composer install

test:
	docker compose exec php-fpm vendor/bin/codecept run

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chown ${USER} console/migrations -R
