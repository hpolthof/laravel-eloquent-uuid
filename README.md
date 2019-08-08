# Laravel Eloquent UUID
Allow the usage of UUID in a MySQL setup.

## How to install?
Install the repository with composer

```bash
composer require hpolthof/laravel-eloquent-uuid
```

Laravel should auto-discover the required service providers.

## How to use?
The package requires [dyrynda/laravel-efficient-uuid](https://github.com/michaeldyrynda/laravel-efficient-uuid),
this package will override the default behaviour of Laravel so that a ```uuid()``` migration will not
become a ```VARCHAR(36)``` but a ```BINARY(16)``` field.

### Trait
Next up you should use the trait ```Hpolthof\Laravel\EloquentUuid\Uuid``` in your Eloquent model.

You'll have to add a method ```uuidColumns()``` to your model. This should return an array with
the fields that are UUIDs.

```php
protected function uuidColumns(): array
{
    return ['id'];
}
``` 

### Primary Key
If you've added your primary key as a UUID column, the model will automatically set a new
UUID on the creation of the model into the database.


## Disclaimer
This package is used for internal development, but published for public use. 
Obviously this software comes *as is*, and there are no warranties or whatsoever.

If you like the package it is always appreciated if you drop a message of gratitude! ;-)

The package was build by: Paul Olthof