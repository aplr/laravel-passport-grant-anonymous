# Laravel Passport: Anonymous Grant

[![Travis](https://img.shields.io/travis/aplr/laravel-passport-grant-anonymous.svg)](https://packagist.org/packages/aplr/laravel-passport-grant-anonymous)
[![Packagist](https://img.shields.io/packagist/v/aplr/laravel-passport-grant-anonymous.svg)](https://packagist.org/packages/aplr/laravel-passport-grant-anonymous)
[![license](https://img.shields.io/github/license/aplr/laravel-passport-grant-anonymous.svg)](https://packagist.org/packages/aplr/laravel-passport-grant-anonymous)

## Introduction

The `laravel-passport-grant-anonymous` package allows you to use a Anonymous Grant in addition to the default Password Grant in Laravel Passport.

This allows "anonymous" users without a password to get an OAuth token using a unique identifier, like eg. a string unique to a user's device.

## Installation

Require the aplr/laravel-passport-grant-anonymous package in your composer.json and update your dependencies:

```shell
$ composer require aplr/laravel-passport-grant-anonymous
```
    
Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
    
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Aplr\LaravelPassportAnonymous\ServiceProvider::class,
```

## Usage

You need to provide a field `auth_id` in the user table such that the associated user model can be retreived later by the grant.

### Prepare your model

To allow this, you either need to provide the field as mentioned, or implement the method `public findByAuthId(string $authId)`,
which returns the user model identified by `authId`.


### Using the grant

After you have prepared your models, you can use the grant as you would normally use the [password grant](https://laravel.com/docs/5.7/passport#requesting-password-grant-tokens), but with the `grant_type` set to `anonymous` and the unique identifier passed using the `auth_id` field. Requesting an access token using the anonymous grant looks like the following:

```php
$http = new GuzzleHttp\Client;

$response = $http->post('http://your-app.com/oauth/token', [
    'form_params' => [
        'grant_type' => 'anonymous',
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'auth_id' => 'some-unique-identifier',
        'scope' => '',
    ],
]);

return json_decode((string) $response->getBody(), true);
```


## Licence

`laravel-passport-grant-anonymous` is open-sourced software licensed under the MIT license.