# Laravel Passport: Anonymous Grant

[![Travis](https://img.shields.io/travis/aplr/laravel-passport-grant-anonymous.svg)](https://packagist.org/packages/aplr/laravel-passport-grant-anonymous)
[![Packagist](https://img.shields.io/packagist/v/aplr/laravel-passport-grant-anonymous.svg)](https://packagist.org/packages/aplr/laravel-passport-grant-anonymous)
[![license](https://img.shields.io/github/license/aplr/laravel-passport-grant-anonymous.svg)](https://packagist.org/packages/aplr/laravel-passport-grant-anonymous)

## Introduction

The `laravel-passport-grant-anonymous` package allows you to use a Anonymous Grant in addition to the default Password Grant in Laravel Passport.

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

## Licence

`laravel-passport-grant-anonymous` is open-sourced software licensed under the MIT license.