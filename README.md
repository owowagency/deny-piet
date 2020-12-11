# Anit Piet

Pieter-Jan is our boss, and he's from Belgium. Being Dutch, we of course don't like him*. That's why we created this package which can deny Piet his access to our API's.

# Installation

Installing this package can be done easily via the following Artisan command.

```bash
composer require owowagency/deny-piet
```

# Setup

To install all the vendor files you can run the following command.

```bash
php artisan vendor:publish --provider="OwowAgency\DenyPiet\ServiceProvider"
```

This will copy the configuration file. 

## Config

Despite the fact that Pieter-Jan is from Belgium, he can me smart (sometimes). So to make this package effective we can block all email address of Piet. By default, we've blocked his main mail address which is "pieter (at) owow (dot) io". If you would like to block more of his email address you can add those to the `email` configuration value.

# Usage

## Validation rule

A validation rule will help you to block Piet from (i.e.) registering or logging in. You can use the validation rule as followed:

```php
$rules = [
    'email' => [
        'required',
        'email',
        new \OwowAgency\DenyPiet\Http\Rules\PietNotAllowed(),
    ],
];
```

## Middleware

Of course, it could also happen that Piet bribed somebody in the office to manually enter his email address in the database. Therefore, we've created a middleware to check if the current authenticated user is Piet. If so, we'll deny his access. 

This middleware is also handy for existing application where Piet already registered.

To implement the middleware you should add it to the `$middleware` array in `App\Http\Kernel.php`:

```php
protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    \App\Http\Middleware\TrustProxies::class,
    \Fruitcake\Cors\HandleCors::class,
    \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    \OwowAgency\DenyPiet\Middleware\DenyAccessToPiet::class,
];
```

---

* Just kidding Piet, we love you ❤️.