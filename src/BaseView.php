<?php


namespace AF;

use AF\Pattern\Singleton;
use eftec\bladeone\BladeOne;
use Exception;


final class BaseView extends BladeOne
{
    use Singleton;

    const CACHE = "/blade/cache";
    const VIEW_DIR_NOT_SET = "Views Directory Not Exists";
    private string $viewsDirectory,
        $cacheDirectory = __DIR__ . self::CACHE;
    public BladeOne $blade;

    public function setBladeInstance()
    {
        if (empty($this->viewsDirectory) or is_null($this->viewsDirectory))
            throw new Exception(self::VIEW_DIR_NOT_SET);
        $this->blade = new BladeOne($this->viewsDirectory, $this->cacheDirectory);
    }

    public function getView()
    {
        return $this->viewsDirectory;
    }

    public function setViewsDirectory(string $directory)
    {
        $this->viewsDirectory = $directory;
    }

    public function setCacheDirectory(string $directory)
    {
        $this->cacheDirectory = $directory;
    }

    public function run($view, $variables = [])
    {
        if(!$variables)
            $variables = [];
        return $this->blade->run($view, $variables);
    }
}
