<?php

/**
 * This file is part of the PropelServiceProvider package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Propel\Tests\Silex;

use Propel\Runtime\Propel;
use Propel\Silex\Propel2ServiceProvider;
use Silex\Application;

/**
 * PropelProvider test cases.
 *
 * Cristiano Cinotti <cristianocinotti@gmail.com>
 */
class PropelServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        //Check if Propel is installed via Composer
        if (false === strpos(file_get_contents('vendor/composer/installed.json'), '"name": "propel/propel"')) {
            $this->markTestSkipped('Propel has to be installed.');
        }
    }

    public function testRegisterWithProperties()
    {
        $app = new Application();
        $app->register(new Propel2ServiceProvider(), array(
            'propel.config_file'    => __DIR__ . '/../../../Fixtures/FixtFull/generated-conf/config.php',
        ));

        //If Propel is initialized, the default datasource is 'bookstore', otherwise 'default'
        $this->assertEquals(Propel::getServiceContainer()->getDefaultDatasource(), 'bookstore');

    }

    public function testRegisterWithDefaults()
    {
        $current = getcwd();
        chdir(__DIR__.'/../../../Fixtures/FixtFull');

        $app = new Application();
        $app->register(new Propel2ServiceProvider());

        $this->assertEquals(Propel::getServiceContainer()->getDefaultDatasource(), 'bookstore');

        chdir($current);
    }

    /**
     * @expectedException  InvalidArgumentException
     * @expectedExceptionMessage  Unable to guess Propel config file. Please, initialize the "propel.config_file" parameter.
     */
    public function testConfigFilePropertyNotInitialized()
    {
        $app = new Application();
        $app->register(new Propel2ServiceProvider());
    }

    public function testWrongConfigFile()
    {
        $current = getcwd();
        try
        {
            chdir(__DIR__.'/../../../Fixtures/FixtEmpty');
            $app = new Application();
            $app->register(new Propel2ServiceProvider());
        }
        catch(\InvalidArgumentException $e)
        {
            chdir($current);
            return;
        }

        chdir($current);
        $this->failed('An expected InvalidArgumentException has not been raised');
    }

}