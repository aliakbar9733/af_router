<?php

namespace AF\Facade;
ini_set("display_errors", "on");

require "../../vendor/autoload.php";

use AF\BaseView;


/**
 * Class View
 * @package AF\Facade
 * @method static run(string $view, array $variables = []);
 * @method static directives(callable $handle);
 */
class View extends BaseFacade
{
    /**
     * @return BaseView
     */
    protected static function getBaseClass()
    {
        return BaseView::getInstance();
    }

    public static function setViewsDirectory(string $directory, string $cache = null)
    {
        $instance = self::getBaseClass();
        $instance->setViewsDirectory($directory);
        if ($cache)
            $instance->setCacheDirectory($cache);
        $instance->setBladeInstance();
    }
}
