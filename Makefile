ci:
	vendor/bin/simple-phpunit
	vendor/bin/phpstan analyze src tests -l 7 -c phpstan.neon
	vendor/bin/ecs check src tests
fix:
	vendor/bin/ecs check src tests --fix
test:
	vendor/bin/simple-phpunit
analyze:
	vendor/bin/phpstan analyze src tests -l 7 -c phpstan.neon
	vendor/bin/ecs check src tests
deploy:
	composer install
	bin/console cache:warmup
