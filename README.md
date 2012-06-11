PropelServiceProvider
=====================

[![Build Status](https://secure.travis-ci.org/propelorm/PropelServiceProvider.png?branch=master)](http://travis-ci.org/propelorm/PropelServiceProvider)

The *Propel2ServiceProvider* provides integration with [Propel2](https://github.com/propelorm/Propel2).

Parameters
----------

* **propel.config_file** (optional): The name of Propel configuration file with full path.
  Default is `/full/project/path/build/conf/projectname-conf.php`


> It's strongly recommanded to use **absolute paths** for previous option.


Services
--------

No service is provided.

Propel configures and manages itself by **using** static methods and its own service container, so no service is registered into Application.
Actually, the PropelServiceProvider class initializes Propel in a more "Silex-ian" way.


Installing
----------

Both Silex and Propel suggest to manage project by using **Composer** (http://getcomposer.org).
In your project directory, add the following lines to your `composer.json` file:

``` json
"require": {
    "propel/propel2-service-provider": "dev-master"
}
```

Then register you model namespace in Composer autoload:

``` json
"autoload": {
     "psr-0": { "Your\\Model\\Namespace": "path/of/your/model" }
}
```


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

* Put `build.properties` and `schema.xml` files into the main directory project,
usually where file `index.php` is located.

* In `build.properties` file, define only `propel.database`, `propel.project`
and `propel.namespace.autopackage` properties.


Usage
-----

You'll have to build the model by yourself. According to Propel documentation, you'll need three files:

* `schema.xml` which contains your database schema;

* `build.properties` more information below;

* `runtime-conf.xml` which contains the database configuration.


Use the `vendor/bin/propel` script to create all files (SQL, configuration, Model classes).

``` yaml
propel.namespace.autopackage = true

The recommended configuration for your `build.properties` file is:

propel.project      = <project_name>

propel.namespace.autoPackage = true
propel.packageObjectModel    = true

# Enable full use of the DateTime class.
# Setting this to true means that getter methods for date/time/timestamp
# columns will return a DateTime object when the default format is empty.
propel.useDateTimeClass = true

# Specify a custom DateTime subclass that you wish to have Propel use
# for temporal values.
propel.dateTimeClass = DateTime

# These are the default formats that will be used when fetching values from
# temporal columns in Propel. You can always specify these when calling the
# methods directly, but for methods like getByName() it is nice to change
# the defaults.
# To have these methods return DateTime objects instead, you should set these
# to empty values
propel.defaultTimeStampFormat =
propel.defaultTimeFormat =
propel.defaultDateFormat =
```

For more information, consult the [Propel documentation](http://www.propelorm.org/documentation/).
