# Effector

[![Build Status](https://travis-ci.org/marcosh/effector.svg?branch=master)](https://travis-ci.org/marcosh/effector)
[![Latest Stable Version](https://poser.pugx.org/marcosh/effector/v/stable)](https://packagist.org/packages/marcosh/effector)
[![Code Climate](https://codeclimate.com/github/marcosh/effector/badges/gpa.svg)](https://codeclimate.com/github/marcosh/effector)
[![Coverage Status](https://coveralls.io/repos/github/marcosh/effector/badge.svg?branch=master)](https://coveralls.io/github/marcosh/effector?branch=master)
[![Code Quality](https://api.codacy.com/project/badge/grade/ff95c3e5360649638c61f2834bffd8b2)](https://www.codacy.com/app/marcosh/effector/dashboard)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/marcosh/effector/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/marcosh/effector/?branch=master)

A Php library to write effect aware code.

In this library you will find a collection of classes, each one representing a single (side) effects.
This allows you to write completely functional code treating effects as data, and delegating their execution
to another component of your application.

You could find more details about the ideas beyond this approach [here](http://marcosh.github.io/post/2017/05/16/manage-effects.html).

## Install

Add this library to your dependencies using [Composer](https://getcomposer.org) with the command

```bash
composer require marcosh/effector
```

## Usage

Every class contained in the `src/Effect` folder represents a single (side) effect.
For example `Marcosh\Effector\Effect\Echo_` represents the operation of echoing a string,
or `Marcosh\Effector\Effect|FileGetContents` represents the operation of reading a file.

You can create a new instance of an effects simply with

```php
$effect = new Echo_();
```

Pay attention to the fact that nothing will actually happen at this moment
(except for the creation of the new instance of the class).

To actually perform the effect described by the class, you will need to invoke it

```php
$effect('hello!');
```

This will actually perform the effect and echo the string passed as argument.

### Compose effects

Representing effects as data is useful since you could pass them around, as input parameters
or as return values of functions. Still if you had not the ability to create more complex effects
from simple ones, they could be quite limiting.

Luckily, composing effects is pretty easy. To do that you could use the `Marcosh\Effector\Compose` class.
This will receive several effects and pieces of logic and combine them in a single complex effect.

For example, if you have an effect that receives an HTTP request and an effect that emits an HTTP response,
you could compose them to create a web application. This could be done as follows:

```php
$websiteLogic = function (RequestInterface $request): ResponseInterface { ... }

$app = Compose::pieces(
    new ReceiveRequest(),
    $websiteLogic,
    new EmitResponse()
);
```

When you compose effects and pieces of logic, you have to be careful the each piece should return
the input for the next one.

## Examples

Several examples of possible usages and functionalities are provided in the `example` folder.

Run an example using

```bash
php example/ArgvEcho.php
```

or, if you are using Docker to obtain a `PHP 7.1` environment, you could use

```
docker run --rm -ti -v "$(pwd):/app" --workdir /app php:7.1-cli php example/ArgvEcho.php
```

The examples contained in `Http.php` and in `SerializeEffect.php` are web application, so you need a web server to try them.
The easiest option is to use the built in PHP web server with

```bash
php -S localhost:8000 example/Http.php
```

or, if you are using Docker,

```bash
docker run --rm -ti -p 8000:8000 -v "$(pwd):/app" php:7.1-cli php -S 0.0.0.0:8000 /app/example/Http.php
```

and then navigate to [localhost:8000](http://localhost:8000) to see it working.