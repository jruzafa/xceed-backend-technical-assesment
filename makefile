include .env
export $(shell sed 's/=.*//' .env)

export UID=$(shell id -u)
export GID=$(shell id -g)

.DEFAULT_GOAL := help

.PHONY: help
help:
	@awk 'BEGIN {FS = ":.*##"; printf "Usage: make \033[36m<target>\033[0m\n"} /^[a-zA-Z0-9_-]+:.*?##/ { printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

## Docker
DOCKER_COMPOSE_DIR=.
DOCKER_COMPOSE_FILES=-f $(DOCKER_COMPOSE_DIR)/docker-compose.yml
DOCKER_COMPOSE=@docker compose $(DOCKER_COMPOSE_FILES) --project-directory $(DOCKER_COMPOSE_DIR) --project-name $(CONTAINER_NAME)
DOCKER_COMPOSE_RUN=@docker compose $(DOCKER_COMPOSE_FILES) --project-directory $(DOCKER_COMPOSE_DIR) --project-name $(CONTAINER_NAME) run --rm php

DOCKER_EXEC=@docker exec -i
DOCKER_EXEC_TTY=$(DOCKER_EXEC) -t --env COLUMNS=`tput cols` --env LINES=`tput lines`

DOCKER_BIN_EXEC=$(DOCKER_EXEC) $(CONTAINER_NAME)-php-fpm
DOCKER_PHP_EXEC=$(DOCKER_BIN_EXEC) php

.PHONY: logs
logs: ## Docker compose logs
	$(DOCKER_COMPOSE) logs -f

.PHONY: shell
shell: ## Docker php bash
	$(DOCKER_EXEC_TTY) $(CONTAINER_NAME)-php-fpm bash

.PHONY: build
build: ## Docker up build and detach services
	$(DOCKER_COMPOSE) up --build -d --force-recreate

.PHONY: up
up: ## Docker up and detach services
	$(DOCKER_COMPOSE) up --detach

.PHONY: debug
debug: ## Docker up and detach services
	export XDEBUG_MODE=debug,coverage;
	$(DOCKER_COMPOSE) up --detach

.PHONY: down
down: ## Docker down
	$(DOCKER_COMPOSE) down

.PHONY: stop
stop: ## Docker stop
	$(DOCKER_COMPOSE) stop

.PHONY: restart
restart: ## Docker restart container. E.g. reset all: "make restart", reset one: "make container=<name> restart"
	$(DOCKER_COMPOSE) restart $(container)

.PHONY: install
install: ## Install dependencies
	$(DOCKER_COMPOSE_RUN) composer install

.PHONY: unit
unit: ## Execute unit test
	$(DOCKER_COMPOSE_RUN) php bin/phpunit --testsuite Unit

.PHONY: acceptance
acceptance: ## Execute unit test
	$(DOCKER_COMPOSE_RUN) php bin/phpunit --testsuite Acceptance

