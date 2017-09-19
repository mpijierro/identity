# Identity for Laravel 5.1

Check valid spanish document id as NIF, CIF, NIE and IBAN back account. 

## Installation

Require this package with composer:

Add in the require section of your composer.json
```php
"mpijierro/identity": "dev-master"
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
Identity::isValidIban('1234foo');
```

methods returns true or false


It is also possible to use **validation rules**:

```php
'nif_field' => 'nif'

'cif_field' => 'cif'

'nie_field' => 'nie'

'iban_field' => 'iban'

```
If error ocurred, error message will be:
```php
 "The $foo_attribute field is not a valid Foo.";
```



## Thanks

The original code for NIF, CIF AND NIE is in next link

http://www.michublog.com/informatica/8-funciones-para-la-validacion-de-formularios-con-expresiones-regulares

Thanks to original code of: globalcitizen/php-iban
 
 https://github.com/globalcitizen/php-iban
