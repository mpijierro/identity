# Identity for Laravel 5.1

Check valid spanish document id as NIF, CIF y NIE

## Installation

Require this package with composer:

```shell
composer require mpijierro/identity
```
After updating composer, add the ServiceProvider to the providers array in config/app.php
> If you use a catch-all/fallback route, make sure you load the Debugbar ServiceProvider before your own App ServiceProviders.

### Laravel 5.x:

```php
\MPijierro\Identity\IdentityServiceProvider::class,
```

If you want to use the facade, add this to your facades in app.php:

```php
'Identity' => MPijierro\Identity\Facades\Identity::class,
```

## Usage

You can now check document ide using the Facade (when added)

```php
Identity::isValidCif('1234foo');
Identity::isValidNif('1234foo');
Identity::isValidNie('1234foo');
```

methods returns true or false


## Thanks

The original code is in next link

http://www.michublog.com/informatica/8-funciones-para-la-validacion-de-formularios-con-expresiones-regulares