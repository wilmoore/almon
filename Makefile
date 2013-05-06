PHPUNIT_BIN ?= $(firstword $(shell which $(CURDIR)/vendor/bin/phpunit) $(shell which phpunit))

test:
	@$(PHPUNIT_BIN)

.PHONY: clean test
