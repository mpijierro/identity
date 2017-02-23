# Identity for Laravel 5.1

Check valid spanish document id as NIF, CIF y NIE

## Installation

Require this package with composer:

```shell
composer require mpijierro/identity
```

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


It is also possible to use **validation rules**:

```php
'nif_field' => 'nif'

'cif_field' => 'cif'

'nie_field' => 'nie'

```
If error ocurred, error message will be:
```php
 "The $attribute field is not a valid NIF.";
```



## Thanks

The original code is in next link

http://www.michublog.com/informatica/8-funciones-para-la-validacion-de-formularios-con-expresiones-regulares