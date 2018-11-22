<a href="https://travis-ci.com/rosstafarian/health-watch-api"><img src="https://img.shields.io/travis/rosstafarian/health-watch-api/master.svg?style=for-the-badge" alt="Build Status"></a>
<a href="https://codecov.io/gh/rosstafarian/health-watch-api"><img src="https://img.shields.io/codecov/c/github/rosstafarian/health-watch-api/master.svg?style=for-the-badge" alt="codecov"></a>

# Health Watch API

This is the API backend for Health Watch. 

It is designed to parse CSV files from health monitoring applications such as [AutoSleep](http://autosleep.tantsissa.com/)

## Built on:

<img src="https://laravel.com/assets/img/components/logo-laravel.svg" height="60px">

* Laravel 5.7
* PHP 7.2
* MySQL/MariaDB (or database of your choice)

## Installation

1. Install PHP >= 7.1 `brew install php`
2. Install [Composer](https://getcomposer.org/) `brew install composer`
3. Install local web server and database
    * [Valet](https://laravel.com/docs/5.6/valet) or [Valet Plus for Mac](https://github.com/weprovide/valet-plus#installation)
are recommended for local hosting/development

4. Run the following commands in the project's directory:

```bash
composer install
```
```bash
# If using Valet Plus
valet db create healthwatch

```
```bash
php artisan key:generate
```
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
```bash
php artisan passport:install
```
