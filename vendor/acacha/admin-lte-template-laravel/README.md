#AdminLTE template Laravel 5 package
A Laravel 5 package that switch default Laravel scaffolding / boilerplate to AdminLTE template with Bootstrap 3.0 and Pratt Landing Page

See demo here:

 http://demo.adminlte.acacha.org/

If you are looking for the Laravel 4 version, use 0.1.5 version/tag and see [OLD-README.md](OLD-README.md)

[![Total Downloads](https://poser.pugx.org/acacha/admin-lte-template-laravel/downloads.png)](https://packagist.org/packages/acacha/admin-lte-template-laravel)
[![Latest Stable Version](https://poser.pugx.org/acacha/admin-lte-template-laravel/v/stable.png)](https://packagist.org/packages/acacha/admin-lte-template-laravel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/acacha/adminlte-laravel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/acacha/adminlte-laravel/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/acacha/adminlte-laravel/badges/build.png?b=master)](https://scrutinizer-ci.com/g/acacha/adminlte-laravel/build-status/master)

# Installation & use

**So easy to install!** Install globally with composer:

```bash
composer global require "acacha/adminlte-laravel-installer=~2.0"
```

And convert any Laravel ~~fresh~~ (no need of fresh installation now thanks to [Acacha/llum](https://github.com/acacha/llum)) installation to AdminLTE/Pratt with:

```bash
laravel new laravel-with-admin-lte
cd laravel-with-admin-lte
adminlte-laravel install
```

Enjoy!

#Requirements

This packages use (no need to install):

* [Composer](https://getcomposer.org/)
* [Laravel](http://laravel.com/)
* [AdminLTE](https://github.com/almasaeed2010/AdminLTE). You can see and AdminLTE theme preview at: http://almsaeedstudio.com/preview/
* [Pratt](http://blacktie.co/demo/pratt/). Pratt Landing Page
* [Acacha/llum](https://github.com/acacha/llum). Easy Laravel packages installation (and other tasks). Used to modify config/app.php file without using stubs (so you changes to this file would be respected)

This package assumes that you have in path your PATH the folder
 
```
/home/sergi/.composer/vendor/bin
```

For example adding this line:

```bash
export PATH=${PATH}:~/.composer/vendor/bin
```

to your ~/.bashrc file

## Llum package

This package now uses [Acacha/llum](https://github.com/acacha/llum) to install packages, providers, aliases, etc in a current existing Laravel project.

Thanks to llum we can install adminlte-laravel package in any Laravel project no need of fresh installation.

However acacha/llum use bash scripts and commands like sed thta maybe are no compatible or not available in all platforms. No problem! You can use a backwards compatible version with:

 ```bash
 laravel new laravel-with-admin-lte
 cd laravel-with-admin-lte
 adminlte-laravel --no-llum install
 ```
 
Or you can use version 1.0 of installer with:
 
```bash
composer global require "acacha/adminlte-laravel-installer=~2.0"
```

## Laravel 5.2

Laravel 5.2 is the default Laravel version supported. See section Installation & use for more info. See below for info about how to install this package in older Laravel versions

### Laravel 5.2 manual installation

Follow the typical Laravel package installation steps:

<pre>
 laravel new laravel-with-admin-lte
 cd laravel-with-admin-lte
</pre>

Add admin-lte Laravel package with:

<pre>
 composer require "acacha/admin-lte-template-laravel:2.*"
</pre> 
 
To register the Service Provider edit **config/app.php** file and add to providers array:

```php
/*
* Acacha AdminLTE template provider
 */
Acacha\AdminLTETemplateLaravel\Providers\AdminLTETemplateServiceProvider::class,
```

To Register Alias edit **config/app.php** file and add to alias array:

```php
/*
* Acacha AdminLTE template alias
*/
'AdminLTE' => Acacha\AdminLTETemplateLaravel\Facades\AdminLTE::class,
```

Publish files with:

```php
php artisan vendor:publish --tag=adminlte --force
``` 
 
Use force to overwrite Laravel Scaffolding packages. That's all! Open the Laravel project in your browser or homestead machine and enjoy! 

## Laravel 5.1 notes

By default Laravel 5.1 does not include default auth routes. Versions > 1.0 < 2.0 of this package add the necessary routes for you

See  [old README file](OLD-README.md) file for notes of which routes are registered.

###Installation

First install Laravel (http://laravel.com/docs/5.0/installation) and then Create a new Laravel project:

<pre>
 laravel new laravel-with-admin-lte
 cd laravel-with-admin-lte
</pre>

Add admin-lte Laravel package with:

<pre>
 composer require "acacha/admin-lte-template-laravel:1.*"
</pre> 
 
Register ServiceProvider editing **config/app.php** file and adding to providers array:

<pre>
// AdminLTE template provider         
Acacha\AdminLTETemplateLaravel\app\Providers\AdminLTETemplateServiceProvider::class,
</pre>

Publish files with:

<pre>
 php artisan vendor:publish --force --provider="Acacha\AdminLTETemplateLaravel\app\Providers\AdminLTETemplateServiceProvider"
</pre> 
 
Use force to overwrite Laravel Scaffolding packages. That's all! Open the Laravel project in your browser or homestead machine and enjoy! 

Note: use the following for Laravel <5.1 versions:

<pre>
 // AdminLTE template provider
 'Acacha\AdminLTETemplateLaravel\app\Providers\AdminLTETemplateServiceProvider',
</pre>

##Laravel Routes

This package add Laravel routes that you will not find them at routes.php file. The routes installed by package would be find at file:

 https://github.com/acacha/adminlte-laravel/blob/master/src/Http/routes.php
 
File included by AdminLTETemplateServiceProvider:

 https://github.com/acacha/adminlte-laravel/blob/master/src/Providers/AdminLTETemplateServiceProvider.php
 
See issue https://github.com/acacha/adminlte-laravel/issues/47 if you want to change default welcome/landing page route.

##First steps, database creation, migrations and login

Once package installed you have to follow the usual steps of any laravel project to Login to the admin interface:

- Create a database. I recommend the use of laravel Homestead ()
- Create/check .env file and configure database acces (database name, password, etc)
- Run migrations with command $ php artisan migrate
- Registera a first user and Login with it

##AdminLTE

AdminLTE is a Free Premium Admin control Panel Theme That Is Based On Bootstrap 3.x created by Abdullah Almsaeed. See:

https://github.com/almasaeed2010/AdminLTE

# Roadmap

- Implement Facebook, Google and maybe twitter and github Login with Socialite
- Add email html templates

## Documentation TODO

- Gulp file provided to compile Boostrap and AdminLTE less files
- Partial views (html header, content header, footer, etc.) to easily reuse code
- Add breadcrumps with: https://github.com/davejamesmiller/laravel-breadcrumbs

## Packagist

https://packagist.org/packages/acacha/admin-lte-template-laravel

## More info

http://acacha.org/mediawiki/AdminLTE#adminlte-laravel

## Tests

Execute:

```
phpunit
```

In new created laravel project with acacha-admintle.laravel installed to test package is installed correctly.

## Social Login

FAQ:

How can I remove social login links in register and login pages?

Remove line @include('auth.partials.social_login') in files resources/views/auth/login.blade.php and register.blade.php

Social login links in login/register pages returns 404 not found

TODO: See package https://github.com/acacha/acacha-socialite

## See also

https://github.com/acacha/adminlte-laravel-installer
