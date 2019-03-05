# Helper for API DocDoc 1.0.6 

[Official API Documentation Version 1.0.6](https://pk.docdoc.ru/docs/partner-api.pdf)

### Install

Install by [composer](http://getcomposer.org/download/).

```
composer require leyhmann/docdochelpers
```

### Example

```php
use Leyhmann\DocDoc\Services\Doctors;
use Leyhmann\DocDoc\Services\Clinics;

$client = new Client(DOCDOC_LOGIN, DOCDOC_PASSWORD);
$doctorsService = new Doctors($client);
$doctors = $doctorsService->all(cityId : int, [count int = 500], [start : int = 1]);

foreach($doctors as $doctor) {
    // do something
}
```

### See Services folder for make request
