.DEFAULT_GOAL := help

dev: ## build development environment
	if ! [ -f .env ];then cp .env.example .env;fi
	docker compose up -d
	docker compose exec -it frankenphp composer install
	docker compose exec -it frankenphp php artisan key:generate
	docker compose exec -it frankenphp php artisan migrate
	docker compose exec -it frankenphp php artisan db:seed
test: ## run tests
	docker compose exec -it frankenphp php artisan test
down: ## shutdown docker
	docker compose down
.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
