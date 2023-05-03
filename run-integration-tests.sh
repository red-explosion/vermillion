#!/usr/bin/env bash

function _test-laravel-version() {
  (
    cd integration-tests/$1
    composer install && ./vendor/bin/phpunit tests
  )
}

if [[ $(php -i | grep "PHP Version => 8") ]]; then
  echo "Testing Laravel 9.x..."
  _test-laravel-version "9.x"
else
  echo "Skipping Laravel 9.x tests -- PHP version too low"
fi
