# yii2 cm-comments module

Author: Philipp Frenzel <philipp@frenzel.net>

cm comments module adds the possibility to add comments to a random model within a view. this is still under heavy development, so pls. don't use in production yet!

[![Latest Stable Version](https://poser.pugx.org/frenzelgmbh/cm-comments/v/stable.svg)](https://packagist.org/packages/frenzelgmbh/cm-comments)
[![Build Status](https://travis-ci.org/FrenzelGmbH/cm-comments.svg?branch=master)](https://travis-ci.org/FrenzelGmbH/cm-comments)
[![Code Climate](https://codeclimate.com/github/FrenzelGmbH/cm-comments.png)](https://codeclimate.com/github/FrenzelGmbH/cm-comments)
[![Version Eye](https://www.versioneye.com/php/FrenzelGmbH:cm-comments/badge.svg)](https://www.versioneye.com/php/FrenzelGmbH:cm-comments)
[![License](https://poser.pugx.org/FrenzelGmbH/cm-comments/license.svg)](https://packagist.org/packages/FrenzelGmbH/cm-comments)


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist frenzelgmbh/cm-comments "*"
```

or add

```
"frenzelgmbh/cm-comments": "*"
```

to the require section of your `composer.json` file.

Configuration
=============

- Add module to config section:

```
'modules' => [
    'comment' => [
        'class' => 'net\frenzel\comment\Module'
    ]
]
```

- Run migrations:

```
php yii migrate --migrationPath=@net/frenzel/comment/migrations
```

- Use in view:

```
<?= \net\frenzel\comment\views\widgets\Comments::widget(['model'=>$model]); ?>
```