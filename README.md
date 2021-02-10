Oddstake PHP SDK
================

![CI](https://github.com/axl-media-org/oddstake-sdk/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/axl-media-org/oddstake-sdk/branch/master/graph/badge.svg)](https://codecov.io/gh/axl-media-org/oddstake-sdk/branch/master)
[![StyleCI](https://github.styleci.io/repos/337331217/shield?branch=master)](https://github.styleci.io/repos/337331217)
[![Latest Stable Version](https://poser.pugx.org/axl-media-org/oddstake-sdk/v/stable)](https://packagist.org/packages/axl-media-org/oddstake-sdk)
[![Total Downloads](https://poser.pugx.org/axl-media-org/oddstake-sdk/downloads)](https://packagist.org/packages/axl-media-org/oddstake-sdk)
[![Monthly Downloads](https://poser.pugx.org/axl-media-org/oddstake-sdk/d/monthly)](https://packagist.org/packages/axl-media-org/oddstake-sdk)
[![License](https://poser.pugx.org/axl-media-org/oddstake-sdk/license)](https://packagist.org/packages/axl-media-org/oddstake-sdk)

Oddstake Odds implementation in PHP.

## 🚀 Installation

You can install the package via composer:

```bash
composer require axl-media-org/oddstake-sdk
```

## 🙌 Usage

### Laravel

```php
use AxlMedia\OddstakeSdk\Facade as Oddstake;

foreach (Oddstake::getSupportedCountries() as $country) {
    $response = Oddstake::soccer($country['feed_name']);
}

```

### PHP

```php
use AxlMedia\OddstakeSdk\Oddstake;

foreach (Oddstake::getSupportedCountries() as $country) {
    $response = (new Oddstake)->soccer($country['feed_name']);
}
```

## 🐛 Testing

``` bash
vendor/bin/phpunit
```

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🎉 Credits

- [All Contributors](../../contributors)
