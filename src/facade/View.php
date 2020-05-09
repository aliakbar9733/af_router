<?php


namespace AF\Facade;


use AF\BaseView;

/**
 * Class View
 * @package AF\Facade
 * @method static setCacheDirectory(string $directory)
 * @method static run(string $view, array $variables = []);
 */
class View extends BaseFacade
{
    protected static function getBaseClass(): object
    {
        return BaseView::getInstance();
    }

    public static function setViewsDirectory(string $directory)
    {
        $instance = self::getBaseClass();
        $instance->setViewsDirectory($directory);
        $instance->setBladeInstance();
    }
}