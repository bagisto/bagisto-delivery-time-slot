## Introduction

Laravel Delivery Time Slot module will allow the admin to set the delivery day along with the delivery time slots for their orders.

Customers can choose their preferred delivery day and time for their order at the time of checkout. After the customers have completed the purchase they can see their selected day and time slot in their order history.

It packs in lots of demanding features that allows your business to scale in no time:

- Customers can choose their preferred day and time for delivery at the time of checkout.
- The admin can select the default allowed days.
- Admin can set the total number of days to display.
- The admin can set the minimum required time for order processing in days.
- Admin can set the error message that will be visible at the time of checkout if no slot is  available.
- Admin can turn off the Laravel Delivery Time Slot from the Admin panel.

## Requirements:

- **Bagisto**: v1.3.3

## Installation with composer:
- Run the following command
```
composer require bagisto/bagisto-delivery-time-slot
```

- Goto config/concord.php file and add following line under 'modules'
```php
\Webkul\DeliveryTimeSlot\Providers\ModuleServiceProvider::class
```

- Run these commands below to complete the setup
```
composer dump-autoload
```

```
php artisan config:cache
php artisan migrate
php artisan route:cache
php artisan optimize
```

```
php artisan vendor:publish --force
```
-> Press the number before DeliveryTimeSlotServiceProvider and then press enter to publish all assets and configurations.

## Installation without composer:

- Unzip the respective extension zip and then merge "packages" folder into project root directory.
- Goto config/app.php file and add following line under 'providers'

```
Webkul\DeliveryTimeSlot\Providers\DeliveryTimeSlotServiceProvider::class
```

- Goto composer.json file and add following line under 'psr-4'

```
"Webkul\\DeliveryTimeSlot\\": "packages/Webkul/DeliveryTimeSlot"
```

- Run these commands below to complete the setup

```
composer dump-autoload
```
```
php artisan optimize
```
```
php artisan migrate
```
```
php artisan route:clear
```

```
php artisan vendor:publish --force
```
-> Press the number before DeliveryTimeSlotServiceProvider and then press enter to publish all assets and configurations.


> That's it, now just execute the project on your specified domain.
