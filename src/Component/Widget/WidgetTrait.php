<?php
/**
 * Widget Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Widget;

/**
 * Trait WidgetTrait
 *
 * @package Devaloka\Component\Widget
 *
 * @property string $idBase
 * @property array $widgetOptions
 * @property array $controlOptions
 * @property bool $isUpdated
 * @property string $optionName
 * @property string $altOptionName
 *
 * @codeCoverageIgnore
 */
trait WidgetTrait
{
    /**
     * {@inheritDoc}
     */
    function __get($name)
    {
        switch ($name) {
            case 'idBase':
                return $this->id_base;

                break;

            case 'widgetOptions':
                return $this->widget_options;

                break;

            case 'controlOptions':
                return $this->control_options;

                break;

            case 'isUpdated':
                return $this->updated;

                break;

            case 'optionName':
                return $this->option_name;

                break;

            case 'altOptionName':
                return $this->alt_option_name;

                break;

            default:
                return $this->{$name};

                break;
        }
    }

    /**
     * {@inheritDoc}
     */
    function __set($name, $value)
    {
        switch ($name) {
            case 'idBase':
                $this->id_base = $value;

                break;

            case 'widgetOptions':
                $this->widget_options = $value;

                break;

            case 'controlOptions':
                $this->control_options = $value;

                break;

            case 'isUpdated':
                $this->updated = $value;

                break;

            case 'optionName':
                $this->option_name = $value;

                break;

            case 'altOptionName':
                $this->alt_option_name = $value;

                break;

            default:
                $this->{$name} = $value;

                break;
        }
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getFieldName($name)
    {
        return $this->get_field_name($name);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getFieldId($name)
    {
        return $this->get_field_id($name);
    }

    /**
     * @return bool
     */
    public function isPreview()
    {
        return $this->is_preview();
    }

    /**
     * @param $arguments
     * @param array|int $widgetArguments
     */
    public function displayCallback($arguments, $widgetArguments = 1)
    {
        $this->display_callback($arguments, $widgetArguments);
    }

    /**
     * @param array|int $deprecated
     */
    public function updateCallback($deprecated = 1)
    {
        $this->update_callback($deprecated);
    }

    /**
     * @param array|int $widgetArguments
     *
     * @return mixed
     */
    public function formCallback($widgetArguments = 1)
    {
        return $this->form_callback($widgetArguments);
    }

    /**
     * @param $settings
     */
    public function saveSettings($settings)
    {
        $this->save_settings($settings);
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->get_settings();
    }
}
