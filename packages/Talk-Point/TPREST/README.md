# TP-REST-Framework

[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://semaphoreci.com/api/v1/projects/03725e83-abe2-402f-9b10-54ca2e0fbc79/671591/badge.svg)](https://semaphoreci.com/k-st-tp/tp-rest-develop)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Talk-Point/tp-rest-develop/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Talk-Point/tp-rest-develop/?branch=master)

Laravel package for REST API creation.

## Install

Via Composer

``` bash
$ composer require Talk-Point/TPREST
```

## Usage

In the Controller use

``` php
try {
    $models = RESTQuery::create(TestModel::class)->query()->get();
    return response()->json($models);
} catch (QueryException $e) {
    return response()->json(['message' => 'DB Query Exception', 'invalid' => $e->errorInfo[2]], 422);
} catch (Exception $e) {
    return response()->json(['message' => 'DB Query Exception'], 422);
}
```

### Parameter

You can combine the parameter to a big search.

#### Query Parameter

Easy search in columns

```sh
http://localhost:8001/tests?title=Prof
```

__Options:__

Filter Parameter with format `column=filter;option`

Possible Options: `equal` `=` `<` `>` `<=` `>=` `<>` `!=` `like` `startwith` `endwith`, `!like`


### Matrix Parameter

#### SortBy

Sort output by a column.

```sh
http://localhost:8001/tests?sortby=id;asc
http://localhost:8001/tests?sortby=id;desc
```

### Combine

```json
http://localhost:8001/tests?title=Pro&sortby=id&is_active=false
[
    {
        "id": "49",
        "title": "Prof. Delphine Cremin",
        "is_active": false,
        "number_integer": 7,
        "number_double": 0,
        "created_at": "2016-01-23 15:21:19",
        "updated_at": "2016-01-23 15:21:19"
    },
    {
        "id": "4",
        "title": "Prof. Beryl Daugherty",
        "is_active": false,
        "number_integer": 9,
        "number_double": 174.430750667,
        "created_at": "2016-01-23 15:21:19",
        "updated_at": "2016-01-23 15:21:19"
    }
]
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email it@talk-point.de instead of using the issue tracker.

## Credits

- [Talk-Point][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Talk-Point/TPREST.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Talk-Point/TPREST/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Talk-Point/TPREST.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Talk-Point/TPREST.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Talk-Point/TPREST.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/Talk-Point/TPREST
[link-travis]: https://travis-ci.org/Talk-Point/TPREST
[link-scrutinizer]: https://scrutinizer-ci.com/g/Talk-Point/TPREST/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Talk-Point/TPREST
[link-downloads]: https://packagist.org/packages/Talk-Point/TPREST
[link-author]: https://github.com/talk-point
[link-contributors]: ../../contributors
