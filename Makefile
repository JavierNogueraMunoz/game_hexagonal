help: # Show all command avalaible
	@grep '^[^#[:space:]].*:' Makefile | tr -d '#' | awk '{gsub(/:/, " ->");print}'

up: # Up application
	./docker/dev/deploy/up
pause: # Pause application
	./docker/dev/deploy/pause
destroy: # Destroy application
	./docker/dev/deploy/destroy
init: # Compiling application
	./docker/dev/deploy/init
artisan: ## Execute command artisan inside container Ej make artisan command=install
	./docker/dev/packege/artisan $(command)
bash: ## Execute command bash inside container Ej make bash command=install
	./docker/dev/packege/bash $(command)
composer: ## Execute command composer inside container Ej make composer package=install
	./docker/dev/composer $(package)
npm: ## Execute command composer inside container Ej make npm package=install
	./docker/dev/npm $(package)
php: ## Execute command php inside container Ej make php php=install
	./docker/dev/php $(php)
test-unit: ## Test Unit
	./docker/dev/test/unit
test-integration: ## Test Integration
	./docker/dev/test/integration
test-all: ## Test Unit and Integration
	./docker/dev/test/all
test-coverage: ## Test coverage
	./docker/dev/test/coverage
test-mutant: ## Test Mutant
	./docker/dev/test/mutant
