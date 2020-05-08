<?php


namespace AF\Facade;


use AF\BaseView;

/**
 * Class View
 * @package AF\Facade
 * @method static setViewsDirectory(string $directory)
 * @method static setCacheDirectory(string $directory)
 * @method static run(string $view, array $variables);
 */
class View extends BaseFacade
{
    protected static function getBaseClass(): object
    {
        return BaseView::getInstance();
    }
}