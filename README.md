# yii2 cm-comments module

Author: Philipp Frenzel <philipp@frenzel.net>

cm comments module adds the possibility to add comments to a random model within a view. this is still under heavy development, so pls. don't use in production yet!


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
