# romans

roman numerals parser

[![Build Status](https://travis-ci.org/taniko/romans.svg?branch=master)](https://travis-ci.org/taniko/romans)


## Installation
```sh
composer require taniko/romans
```

## Usage
```php
<?php
use Taniko\Romans\Parser;
Parser::toInt('MMXVII'); // 2017
Parser::toInt('MMⅩVII'); // 2017 (Ⅹ is U+2169)
Parser::toRoman(2017);   // MMXVII
```
