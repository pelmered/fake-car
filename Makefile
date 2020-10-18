TESTS_DIR=./tests/Faker
VENDOR_DIR=./vendor

PHPUNIT_BIN=./vendor/phpunit/phpunit/phpunit
PHP_BIN=php
COMPOSER_BIN=composer

list: 			# Display this list
	@cat Makefile \
		| grep "^[a-z0-9_]\+:" \
		| sed -r "s/:[^#]*?#?(.*)?/\r\t\t\t\t-\1/" \
		| sed "s/^/ • make /" \
		| sort


install:	# Install dependencies
	@$(COMPOSER_BIN) install --no-dev 2>&1

install-dev:# Install with dev dependencies
	@$(COMPOSER_BIN) install 2>&1

update:		# Update dependencies
	@$(COMPOSER_BIN) update

autoloader:	# Dump autoloader
	@$(COMPOSER_BIN) dump-autoload

test:		# Run tests
	@$(PHP_BIN) $(PHPUNIT_BIN) -c $(TESTS_DIR)/phpunit.xml

test-coverage:	# Show codecoverage
	@$(PHP_BIN) $(PHPUNIT_BIN) --coverage-text  -c $(TESTS_DIR)/phpunit.xml
