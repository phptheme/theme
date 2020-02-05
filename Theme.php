<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Theme;

class Theme implements ThemeInterface
{

    public function __construct()
    {
    }

    public function beginContent()
    {
        ob_start();
    }

    public function endContent()
    {
        return ob_get_clean();
    }

    public function widget($class, $params = [])
    {
        if (!is_array($params) && !$params)
        {
            return '';
        }

        $widget = $this->createWidget($class, $params);
        
        return $widget->toString();
    }

    public function createWidget(string $class, array $params = [])
    {
        $widget = new $class($params);

        return $widget;
    }

    public function beginWidget(string $class, array $params = [])
    {
        $widget = $this->createWidget($class, $params);

        $this->beginContent();

        return $widget;
    }

    public function endWidget($widget, $display = true)
    {
        $content = $this->endContent();

        $widget->content = $content;

        $return = $widget->toString();

        if ($display)
        {
            echo $return;
        }
        else
        {
            return $return;
        }
    }

}