# laravel-excel-helper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require alive2212/laravel-excel-helper
```

## Usage

``` php
    $user = new User();
    $excelHelper = new ExcelHelper();
    return $excelHelper->table($user->get()->toArray())->createExcelFile()->download();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email alive2212@yahoo.com instead of using the issue tracker.

## Credits

- [Babak Nodoust][link-author]
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Alive2212/laravel-excel-helper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Alive2212/LaravelExcelHelper/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Alive2212/LaravelExcelHelper.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Alive2212/LaravelExcelHelper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Alive2212/laravel-excel-helper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/alive2212/laravel-excel-helper
[link-travis]: https://travis-ci.org/Alive2212/LaravelExcelHelper
[link-scrutinizer]: https://scrutinizer-ci.com/g/Alive2212/LaravelExcelHelper/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Alive2212/LaravelExcelHelper
[link-downloads]: https://packagist.org/packages/Alive2212/laravel-excel-helper
[link-author]: https://github.com/https://github.com/Alive2212
[link-contributors]: ../../contributors
