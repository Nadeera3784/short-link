# Short Link Application

Short Link is a simple link shortening application written in VueJS and Laravel.

## Features

-    Duplicate URL detection
-    Threat lookup with Yandex API
-   Simple UI

## Tech

Short Link uses a number of open source projects to work properly:

- VueJS 3
- Laravel 10
- Tailwind
- Mysql
- Vite
- Vitest

## Installation

Short Link requires, 
[Node.js](https://nodejs.org/) v18+ 
[PHP](https://www.php.net/) v8.1+ 

Install the dependencies and devDependencies

```sh
composer install
npm install
```

Rename the .env.example to .env and update the environment variables


> Note: `The threat lookup feature requires a Yandex API key.` https://yandex.com/dev/safebrowsing/doc/quickstart/concepts/lookup.html


Setup the database dump (database/dump/linkShort.sql)

Clear the laravel cache
```sh
php artisan cache:clear
php artisan config:clear
```

Build the front-end with npm
```sh
npm run dev or npm run watch
```

## Docker

Short Link is very easy to install and deploy in a Docker container.

```sh
docker compose build
docker compose up -d
```

## Development

Run PHP Unit Test

```sh
./vendor/bin/phpunit
```

Run Front-end unit testing

```sh
npm run test
```
code formatting

```sh
vendor/bin/phpcs --standard=phpcs.xml [file path]
```