.PHONY: help
## === 🆘  HELP ==================================================
help: ## Show this help.
	@echo "Laravel Makefile"
	@echo "---------------------------"
	@echo "Usage: make [target]"
	@echo ""
	@echo "Targets:"
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
#---------------------------------------------#

.PHONY: helpers

helpers:
	php artisan ide-helper:generate
	php artisan ide-helper:models -F helpers/ModelHelper.php -M
	php artisan ide-helper:meta

.PHONY: formatage

formatage:
	php ./vendor/bin/pint

.PHONY: analyse

analyse:
	php ./vendor/bin/phpstan analyse --xdebug --memory-limit=2G

#---PHPQA---#
PHPQA = jakzal/phpqa
PHPQA_RUN = docker run --init --rm -v $(PWD):/project -w /project $(PHPQA)
#------------#

#--PHPUNIT---#
PHPUNIT = ./vendor/bin/phpunit

## === 🎛️  LARAVEL  ===============================================
laravel: # List  Laravel commands.
	@php artisan

laravel-start: ## Start the Laravel development server.
	ENV=development php artisan serve

laravel-clean-cache: ## Clean Laravel cache.
	php artisan cache:clear
	php artisan view:clear

laravel-clear-views: ## Clear Laravel views.
	php artisan view:clear

laravel-clear-assets: ## Clear Laravel assets.
	php artisan clear-compiled
	php artisan optimize

laravel-clear-config: ## Clear Laravel config.
	php artisan config:clear

laravel-clear-logs: ## Clear Laravel logs.
	php artisan logs:clear

laravel-migrate: ## Run Laravel migrations.
	php artisan migrate

laravel-seed: ## Run Laravel seeds.
	php artisan db:seed

laravel-tinker: ## Run Laravel tinker.
	php artisan tinker

laravel-mail-browser: ## Run Laravel mail browser.
	./bin/mailpit
#---------------------------------------------#

## === 📦  COMPOSER ==============================================
composer-install: ## Install composer dependencies.
	composer install
.PHONY: composer-install

composer-update: ## Update composer dependencies.
	composer update
.PHONY: composer-update

composer-validate: ## Validate composer.json file.
	composer validate
.PHONY: composer-validate

composer-validate-deep: ## Validate composer.json and composer.lock files in strict mode.
	composer validate --strict --check-lock
.PHONY: composer-validate-deep
#---------------------------------------------#

## === 📦  NPM ===================================================
npm-install: ## Install npm dependencies.
	npm install
.PHONY: npm-install

npm-update: ## Update npm dependencies.
	npm update
.PHONY: npm-update

npm-build: ## Build assets.
	npm run build
.PHONY: npm-build

npm-dev: ## Build assets in dev mode.
	npm run dev
.PHONY: npm-dev
#---------------------------------------------#

## === 🐛  PHPQA =================================================
qa-cs-fixer-dry-run: ## Run php-cs-fixer in dry-run mode.
	$(PHPQA_RUN) php-cs-fixer fix -vvv --dry-run --show-progress=dots
.PHONY: qa-cs-fixer-dry-run

qa-cs-fixer: ## Run php-cs-fixer.
	$(PHPQA_RUN) php-cs-fixer fix -vvv --show-progress=dots
.PHONY: qa-cs-fixer

qa-phpstan: ## Run phpstan.
	$(PHPQA_RUN) phpstan analyse --memory-limit=2G
.PHONY: qa-phpstan

qa-php-metrics: ## Run php-metrics.
	$(PHPQA_RUN) phpmetrics --report-html=storage/qa/phpmetrics ./app
.PHONY: qa-php-metrics

qa-phpcpd: ## Run phpcpd (copy/paste detector).
	$(PHPQA_RUN) phpcpd ./app
.PHONY: qa-phpcpd

qa-audit: ## Run composer audit.
	composer audit
.PHONY: qa-audit
#---------------------------------------------#

## === 🔎  TESTS =================================================
tests: ## Run tests.
	$(PHPUNIT) --testdox
.PHONY: tests

tests-coverage: ## Run tests with coverage.
	XDEBUG_MODE=coverage $(PHPUNIT) --coverage-html storage/qa/coverage
.PHONY: tests-coverage
#---------------------------------------------#

## === ⭐  OTHERS =================================================
before-commit: formatage analyse qa-cs-fixer qa-phpstan tests ## Run before commit.
.PHONY: before-commit

first-install: composer-install npm-install npm-build laravel-start ## First install.
.PHONY: first-install

start: laravel-start ## Start project.
.PHONY: start
#---------------------------------------------#
