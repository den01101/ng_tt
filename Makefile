start:
	@./etc/docker/bin/start.sh
.PHONY: start

fixer:
	@docker exec -t ng_app sh -c " ./vendor/bin/php-cs-fixer fix"
.PHONY: fixer

stan:
	@./vendor/bin/phpstan analyse --memory-limit=2G
.PHONY: stan

unit:
	@docker exec -t ng_app sh -c "./vendor/bin/phpunit"
.PHONY: unit