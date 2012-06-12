PropelServiceProvider
=====================

[![Build Status](https://secure.travis-ci.org/propelorm/PropelServiceProvider.png?branch=master)](http://travis-ci.org/propelorm/PropelServiceProvider)

The *Propel2ServiceProvider* provides integration with [Propel2](https://github.com/propelorm/Propel2) and [Silex](http://silex.sensiolabs.org)

**Be careful:** Propel2 is still under heavy development. Please use [PropelServiceProvider](https://github.com/propelorm/PropelServiceProvider) and [Propel1](https://github.com/propelorm/Propel) for production.


Parameters
----------

* **propel.config_file** (optional): The name of Propel configuration file with full path.
  Default is `/full/project/path/generated-conf/config.php`


> It's strongly recommanded to use **absolute paths** for previous option.


Services
--------

No service is provided.

Propel configures and manages itself by **using** static methods and its own service container, so no service is registered into Application.
Actually, the Propel2ServiceProvider class initializes Propel in a more "Silex-ian" way.


Installing
----------

Both Silex and Propel suggest to manage your projects by using **Composer** (http://getcomposer.org). Please, read [Composer documentation](http://getcomposer.org/doc/) before going ahead.

In your project directory, add the following lines to your `composer.json` file:

``` json
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/cristianoc72/Propel2ServiceProvider"
        }
    ],
"require": {
    "cristianoc72/propel2-service-provider": ">=0.1"
}
```

Then register you model namespace in Composer autoload:

``` json
"autoload": {
     "psr-0": { "Your\\Model\\Namespace": "path/of/your/model" }
}
```

Then install Composer and all dependencies:

    wget http://getcomposer.org/composer.phar

    php composer.phar install



Registering
-----------

After you've installed *Propel2ServiceProvider* and its dependencies, you can register Propel2ServiceProvider in your application:

``` php
<?php

$app->register(new Propel\Silex\Propel2ServiceProvider(), array(
    'propel.config_file' => __DIR__.'/path/to/myproject-conf.php'
));
```

Alternatively, if you built your model with default Propel generator options:

``` php
<?php

$app->register(new Propel\Silex\Propel2ServiceProvider());
```


We can consider "default" Propel generator options:

* Put `schema.xml` files into the main directory project
* Run `vendor/bin/propel model:build` command without specify any options about directories and namespace package.



Usage
-----

You'll have to build the model by yourself. According to Propel documentation, you'll need two files:

* `schema.xml` which contains your database schema;

* `runtime-conf.xml` which contains the database configuration.


Use the `vendor/bin/propel` script to create all files (SQL, configuration, Model classes).

    vendor/bin/propel model:build
    vendor/bin/propel config:convert-xml
    vendor/bin/propel sql:build
    .................

Propel2 documentation is still in development and you can find it [here](http://github.com/propelorm/Propel2/documentation).
*schema.xml* and *runtime-conf.xml* reference can be found here: http://www.propelorm.org/reference/schema.html, http://www.propelorm.org/reference/runtime-configuration.html
