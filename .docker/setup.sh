#!/bin/sh
cd /var/www/ || exit

# composerの実行
export COMPOSER_ALLOW_SUPERUSER=1

cp .env-local-docker .env

if [ "$APP_ENV" == "local" ] || [ "$APP_ENV" == "dev" ] || [ "$APP_ENV" == "dev2" ]
then
  # local, dev, dev2
  composer install --no-interaction
  cp .env.testing-docker .env.testing
else
  # prd, stg
  composer install --no-interaction --optimize-autoloader --no-dev
fi

if [ "$APP_ENV" != "local" ]
then
  # caching
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache

  npm install
  npm run prod
fi