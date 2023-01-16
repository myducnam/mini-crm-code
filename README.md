# Demo


## Environment
- [Laravel 9.0 (LTS)](https://laravel.com/docs/9.x/)
- PHP 8.1.*
- MySQL 5.7 (Amazon Aurora)

## Libraries
### Common
- [Laravel Collective (Forms & Html)](https://laravelcollective.com/docs/6.0/html)
- [Laravel enum](https://github.com/BenSampo/laravel-enum)
- [Eloquent insert on duplicate key](https://github.com/guidocella/eloquent-insert-on-duplicate-key)
- [Eloquent Filter](https://github.com/Tucker-Eric/EloquentFilter)
- [Column sorting for Laravel](https://github.com/Kyslik/column-sortable)
### Development
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
- [GrumPHP](https://github.com/phpro/grumphp)
- [PHPMD](https://github.com/phpmd/phpmd)
- [PHPCPD](https://github.com/sebastianbergmann/phpcpd)

## Setup
### On Docker
1. Clone repository 
    ```shell
    git clone https://github.com/myducnam/mini-crm-code.git && cd mini-crm-code
    ```
2. Build docker image
    ```shell
    docker-compose build
    ```
3. Execute setup.sh
    - On MacOS, Linux:
    ```shell
    docker-compose run --rm web sh -c "export APP_ENV=local; .docker/setup.sh"
    ```
    - On Windows:
    ```shell
    docker-compose run --rm web sh -c "export APP_ENV=local; sed -i 's/\r$//' .docker/setup.sh; .docker/setup.sh"
    ```
4. Start docker containers
    ```shell
    docker-compose up -d
    ```
5. Run composer
    ```shell
    docker-compose exec web sudo -u www composer install
    ```
6. Run migration
    ```shell
    docker-compose exec web sudo -u www php artisan migrate
    ```
7. Run seeder
    ```shell
    docker-compose exec web sudo -u www php artisan db:seed
    ```
8. Install NodeJS dependencies & build assets
    ```shell
    docker-compose exec web sudo -u www npm install
    docker-compose exec web sudo -u www npm run dev
    ```
9. Update hosts
    ```
    ...
    127.0.0.1 demo-services.local
    ```
10. Trust the cetificate
    - On MacOS:
    ```shell
    sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain ./.docker/nginx/cert/self-signed.crt
    ```
    - On Windows:
    ```shell
    - Navigate to ".docker/nginx/cert" folder and double click on self-signed.crt file
    - Click "Install Certificate..." button
    - Click "Next" button
    - Select "Place all certificates in the following store" then click "Browse..." button
    - Select "Trusted Root Certification Authorities" then click "OK" button
    - Click "Next" button
    - Click "Finish" button
    ```
11. Access url: https://demo-services.local:14080/eb5e2aepk74bp2sfu429fseynwcknay4
    ```
#### Docker Tips
- [Admin url](https://demo-services.local:14080/eb5e2aepk74bp2sfu429fseynwcknay4)
- [Mailcatcher url](http://localhost:14088/)
- Install new composer package
    ```shell
    docker-compose exec web sudo -u www composer require vendor/package-name
    ```
- Migration  
    ```shell
    docker-compose exec web sudo -u www php artisan migrate
    ```
- Install new npm package
    ```shell
    docker-compose exec web sudo -u www npm install package-name
    ```
- Build assets and watch for changes
    ```shell
    docker-compose exec web sudo -u www npm run watch
    ```

If you want to send & catch mail on local 

just fix .env like below(don't forget to comment out MAIL_DRIVER=sendgrid)

access above link address and you can see what you sent!
```
MAIL_DRIVER=smtp 
MAIL_HOST=mailcatcher
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_PRETEND=false
```

  |name|val|
  |---|---|
  |transport|smtp|
  |host|mailcatcher|
  |port|1025|
- access to container  
`docker-compose exec -it [container name] bash`


    ```

## Tips
### Cache clear
composer c
### Laravel Mix
- Install modules  
`npm install && npm run dev`
- monitoring  
`npm run watch-poll`

```
### Routes
- e.g. Route::resource('user', 'UserController')

  |Method|URI|Action|Route name|
  |---|---|---|---|
  |GET|/user|index|user.index|
  |GET|/user/create|create|user.create|
  |POST|/user|store|user.store|
  |GET|/user/{user}|show|user.show|
  |GET|/user/{user}/edit|edit|user.edit|
  |PUT/PATCH|/user/{user}|update|user.update|
  |DELETE|/user/{user}|destroy|user.destroy|

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
