# Laravel Broadcasting SNS Driver

This package is currently in an alpha state, and does not yet work in Lumen.

### Usage

In config/broadcasting.php set the default driver to 'sns' and add configuration options like this:

```php
'default' => 'sns,
'connections' => [
    ...
    'sns' => [
        'driver' => 'sns',
        'aws_key' => env('AWS_SNS_KEY'),
        'aws_secret' => env('AWS_SNS_SECRET'),
        'aws_region' => env('AWS_SNS_REGION')
    ],
    ...
]
```

In config/app.php, add the SNS Service Provider to your Providers array:

```php
'providers' => [
    ...
    Ringtrail\LaravelSns\SnsBroadcastServiceProvider::class,
    ...
]
```

Follow the event broadcasting instructions in the Laravel documentation. Your channel will be any SNS topic
you've already created in the AWS console.
