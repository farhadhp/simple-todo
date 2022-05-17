# SimpleTodo
A simple Todo package for Laravel

<a href="https://scrutinizer-ci.com/g/farhadhp/simple-todo"><img src="https://img.shields.io/scrutinizer/g/farhadhp/simple-todo.svg?style=round-square" alt="Quality Score"></img></a>
[![code coverage](https://codecov.io/gh/farhadhp/simple-todo/branch/master/graph/badge.svg)](https://codecov.io/gh/farhadhp/simple-todo)
[![Build Status](https://travis-ci.org/farhadhp/simple-todo.svg?branch=master)](https://travis-ci.org/farhadhp/simple-todo)
[![Latest Stable Version](https://poser.pugx.org/farhadhp/simple-todo/v/stable)](https://packagist.org/packages/farhadhp/simple-todo)
[![Daily Downloads](https://poser.pugx.org/farhadhp/simple-todo/d/daily)](https://packagist.org/packages/farhadhp/simple-todo)
[![Total Downloads](https://poser.pugx.org/farhadhp/simple-todo/downloads)](https://packagist.org/packages/farhadhp/simple-todo)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=round-square)](LICENSE.md)

### Installation
```
composer require farhadhp/simple-todo
```
**After installing the package please add `SimpleTodo` trait to your project user model.**

### publish vendor files:

#### migrations
```
php artisan vendor:publish --tag=simple_todo_migrations
```
#### configs
```
php artisan vendor:publish --tag=simple_todo_config
```
#### locale
```
php artisan vendor:publish --tag=simple_todo_lang
```

### License
MIT 
