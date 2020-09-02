A tiny lib for copy properties from one to another even if the property is not public.

## Installation
```shell script
composer require yaquawa/look-alike
```

## Usage
```php
use Yaquawa\LookAlike\LookAlike;

$lookAlike = new LookAlike($targetObjectOrClass);
$lookAlike->syncProperties($objectOrClass, ['property_1', 'property_2']);
```