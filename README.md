# Kirby Stopwatch

![Release](https://flat.badgen.net/packagist/v/bnomei/kirby3-stopwatch?color=ae81ff)
![Downloads](https://flat.badgen.net/packagist/dt/bnomei/kirby3-stopwatch?color=272822)
[![Build Status](https://flat.badgen.net/travis/bnomei/kirby3-stopwatch)](https://travis-ci.com/bnomei/kirby3-stopwatch)
[![Coverage Status](https://flat.badgen.net/coveralls/c/github/bnomei/kirby3-stopwatch)](https://coveralls.io/github/bnomei/kirby3-stopwatch)
[![Maintainability](https://flat.badgen.net/codeclimate/maintainability/bnomei/kirby3-stopwatch)](https://codeclimate.com/github/bnomei/kirby3-stopwatch)  
[![Twitter](https://flat.badgen.net/badge/twitter/bnomei?color=66d9ef)](https://twitter.com/bnomei)

Profile your Kirby CMS code with precision in milliseconds (or seconds). 

## Installation

- unzip [master.zip](https://github.com/bnomei/kirby3-stopwatch/archive/master.zip) as folder `site/plugins/kirby3-stopwatch` or
- `git submodule add https://github.com/bnomei/kirby3-stopwatch.git site/plugins/kirby3-stopwatch` or
- `composer require bnomei/kirby3-stopwatch`

## Works well with

- [Janitor Plugin](https://github.com/bnomei/kirby3-janitor)
- [Monolog Plugin](https://github.com/bnomei/kirby3-monolog)

## Usage Site Method

Please read the [Symfony Stopwatch Component Docs](https://symfony.com/doc/current/components/stopwatch.html) since this plugin is just a soft wrapper around it. Some Examples:

**Event Duration**
```php
site()->stopwatch()->start('myevent');
sleep(1);
site()->stopwatch()->stop('myevent');
echo site()->stopwatch()->duration('myevent') . PHP_EOL; // float | int
```

**Event with Laps aka Periods**
```php
$eventName = 'my event with laps';
$stopwatch = site()->stopwatch();
$stopwatch->start($eventName);
foreach ([random_int(100,500),random_int(100,500),random_int(100,500)] as $time) {
    usleep($time);
    $stopwatch->lap($eventName);
}
usleep(100);
$stopwatch->stop($eventName);
$totalDuration = $stopwatch->duration($eventName); // float | int
echo $totalDuration . PHP_EOL;
foreach ($stopwatch->getEvent($eventName)->getPeriods() as $period) {
    echo $period->getDuration() . PHP_EOL;  // float | int
}
```

## Usage PHP Class

You can use the provided php class in your own classes if you make sure the class is loaded before you call it. This can be done in installing this plugin using composer or in manually requiring it with [Kirby's class loader](https://getkirby.com/docs/reference/templates/helpers/load).

```php
$stopwatch = \Bnomei\Stopwatch::singleton();
$stopwatch->start('my event with laps');
sleep(1);
$stopwatch->stop('my event with laps');
$duration = $stopwatch->duration('my event with laps'); // float | int
```

## Settings

| bnomei.stopwatch.           | Default        | Description               |            
|---------------------------|----------------|---------------------------| 
| precision | `true` | measure microseconds as float or int seconds. |

> NOTE: This plugin defaults to measuring in milliseconds but the symfony component does not.

## Dependencies

- [symfony/stopwatch](https://github.com/symfony/stopwatch)

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bnomei/kirby3-stopwatch/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
