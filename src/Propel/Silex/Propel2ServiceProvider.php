<?php

/**
 * This file is part of the PropelServiceProvider package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Propel\Silex;

use Propel\Runtime\Propel;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Propel2 service provider.
 *
 * @author Cristiano Cinotti <cristianocinotti@gmail.com>
 */
class Propel2ServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (!class_exists('Propel\\Runtime\\Propel', true)) {
            throw new \InvalidArgumentException('Unable to find Propel, did you install it?');
        }

        if (isset($app['propel.config_file'])) {
            $config = $app['propel.config_file'];
        } else {
            $config = './generated-conf/config.php';
        }
        if (!file_exists($config)) {
            throw new \InvalidArgumentException('Unable to guess Propel config file. Please, initialize the "propel.config_file" parameter.');
        }

        Propel::init($config);
    }

    public function boot(Application $app)
    {

    }
}