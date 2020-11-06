user := $(shell id -u)
group := $(shell id -g)
dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose
de := docker-compose exec
php-fpm := $(de) php-fpm
artisan := $(php-fpm) php artisan

.DEFAULT_GOAL := help
.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: build-docker
build-docker:
	$(dc) pull --ignore-pull-failures
	$(dc) build php-fpm

.PHONY: dev
dev: ## Start dev server
	$(dc) up

.PHONY: start
start: ## Start production server
	$(dc) up -d

.PHONY: stop
stop: ## Stop production server
	$(dc) down

.PHONY: init
init: composer/install key migrate seed ## FirstTime initialisation (docker-compose must be up)

.PHONY: migrate
migrate: ## Database migration (docker-compose must be up)
	$(artisan) migrate

.PHONY: seed
seed: ## Database seed (docker-compose must be up)
	$(artisan) db:seed

.PHONY: fresh
fresh: ## Database fresh & seed (docker-compose must be up)
	$(artisan) migrate:fresh --seed

key:
	$(artisan) key:generate

composer/install:
	$(php-fpm) composer install
