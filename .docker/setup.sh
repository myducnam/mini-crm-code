#!/bin/sh
cd /var/www/ || exit

# composer
export COMPOSER_ALLOW_SUPERUSER=1

cp .env-local-docker .env

mkdir -p storage/framework/sessions && mkdir -p storage/framework/views
mkdir -p storage/framework/cache && mkdir bootstrap/cache
chown www:www -R /var/www/storage/*

if [ "$APP_ENV" == "local" ] || [ "$APP_ENV" == "dev" ] || [ "$APP_ENV" == "dev2" ]
then
  # local, dev, dev2
  composer install --no-interaction
  php artisan migrate
  php artisan db:seed
  npm install
  npm run dev
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