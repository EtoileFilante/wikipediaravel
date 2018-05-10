# Wikipediaravel
A simple Wikipedia API Driver

[![Build Status](https://travis-ci.org/EtoileFilante/wikipediaravel.svg?branch=master)](https://travis-ci.org/EtoileFilante/wikipediaravel)
[![Coverage Status](https://coveralls.io/repos/github/EtoileFilante/wikipediaravel/badge.svg?branch=master)](https://coveralls.io/github/EtoileFilante/wikipediaravel?branch=master)

## Installation
```
composer require etoilefilante/wikipediaravel
```

## Configuration
You can configure the type of data sent back by wikipedia. By default, we'll send you json. If you change your mind, just edit your configuration in your .env 

```WIKIPEDIARAVEL_FORMAT = ```

Possible values are : jsonn, jsonfm (pretty-print in HTML), php, phpfm, rawfm, xml, xmlfm.

As for language, default is french.
To switch to english, add
```WIKIPEDIARAVEL_LANG = en``` in your .env file.

## Use
Available functions

```
getPage($pageName)
getSubCategories($category, $depth = 1)
```