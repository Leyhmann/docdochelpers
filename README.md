# DocDoc API Client 1.0.12

[Official API Documentation Version 1.0.12](https://dd1012.docs.apiary.io)

### Install

Install by [composer](http://getcomposer.org/download/).

```
composer require leyhmann/docdochelpers
```

### Example

```php
use Leyhmann\DocDoc\Services\DoctorsService;

$client = new Client(DOCDOC_LOGIN, DOCDOC_PASSWORD);
$doctorsService = new DoctorsService($client);
$doctors = $doctorsService->all($cityId : int, $count: int|null, $start: int|null);

foreach($doctors as $doctor) {
    // do something
}
```

### See Services folder for make request
