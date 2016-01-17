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
 * @property mixed[] $widgetOptions
 * @property mixed[] $controlOptions
 * @property bool $updated
 * @property string $optionName
 * @property string $altOptionName
 */
trait WidgetTrait
{
    /**
     * Gets a property value of WP_Widget by a camelCase name.
     */
    public function __get($name)
    {
        /** @var $this \WP_Widget */

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

            case 'updated':
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
     * Sets a property value of WP_Widget by a camelCase name.
     */
    public function __set($name, $value)
    {
        /** @var $this \WP_Widget */

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

            case 'updated':
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
     * Gets the Widget name.
     *
     * @return string The Widget name.
     */
    public function getName()
    {
        /** @var $this \WP_Widget */

        return $this->name;
    }

    /**
     * Gets the Widget options.
     *
     * @return mixed[] The options.
     */
    public function getOptions()
    {
        /** @var $this \WP_Widget */

        return $this->widget_options;
    }

    /**
     * Renders a Widget.
     *
     * @param mixed[] $args The Widget arguments for output including `before_title`, `after_title`, `before_widget`,
     *                      and `after_widget`.
     * @param mixed[] $instance The instance-specific Widget settings.
     *
     * @return string The rendered HTML.
     */
    public function render(array $args, array $instance)
    {
        ob_start();

        parent::widget($args, $instance);

        return ob_get_clean();
    }

    /**
     * Displays a Widget.
     *
     * @param mixed[] $args The Widget arguments for output including `before_title`, `after_title`, `before_widget`,
     *                      and `after_widget`.
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function display(array $args, array $instance)
    {
        echo $this->render($args, $instance);
    }

    /**
     * Displays a Widget.
     *
     * @see WidgetInterface::display :alias:
     *
     * @param mixed[] $args The Widget arguments for output including `before_title`, `after_title`, `before_widget`,
     *                      and `after_widget`.
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function widget($args, $instance)
    {
        $this->display($args, $instance);
    }

    /**
     * Gets the `name` attribute value for a field.
     *
     * @see \WP_Widget::get_field_name() :alias:
     *
     * @param string $name The field name.
     *
     * @return string The `name` attribute value for the $name.
     */
    public function getFieldName($name)
    {
        /** @var $this \WP_Widget */

        return $this->get_field_name($name);
    }

    /**
     * Gets the `id` attribute value for a field.
     *
     * @see \WP_Widget::get_FieldId() :alias:
     *
     * @param string $name The field name.
     *
     * @return string The field ID.
     */
    public function getFieldId($name)
    {
        /** @var $this \WP_Widget */

        return $this->get_field_id($name);
    }

    /**
     * Returns whether the current request is inside the Customizer preview.
     *
     * @see \WP_Widget::is_preview() :alias:
     *
     * @return bool True if within the Customizer preview, false if not.
     */
    public function isPreview()
    {
        /** @var $this \WP_Widget */

        return $this->is_preview();
    }

    /**
     * The callback to output Widget content.
     *
     * @see \WP_Widget::display_callback() :alias:
     *
     * @param mixed[] $arguments The Widget arguments for output.
     * @param int|int[] $widgetArguments The order number of the Widget instance, or an array of multi-widget arguments.
     */
    public function displayCallback($arguments, $widgetArguments = 1)
    {
        /** @var $this \WP_Widget */

        $this->display_callback($arguments, $widgetArguments);
    }

    /**
     * The callback to handle changed settings.
     *
     * @see \WP_Widget::update_callback() :alias:
     *
     * @param int $deprecated Not used.
     */
    public function updateCallback($deprecated = 1)
    {
        /** @var $this \WP_Widget */

        $this->update_callback($deprecated);
    }

    /**
     * The callback to generate the Widget control form.
     *
     * @see \WP_Widget::form_callback :alias:
     *
     * @param int|int[] $widgetArguments The Widget instance number or an array of widget arguments.
     *
     * @return string|null The form HTML, or null if no form to output.
     */
    public function formCallback($widgetArguments = 1)
    {
        /** @var $this \WP_Widget */

        return $this->form_callback($widgetArguments);
    }

    /**
     * Saves the settings for all instances of the Widget class.
     *
     * @see \WP_Widget::save_settings() :alias:
     *
     * @param mixed[] $settings The multi-dimensional array of widget instance settings.
     */
    public function saveSettings($settings)
    {
        /** @var $this \WP_Widget */

        $this->save_settings($settings);
    }

    /**
     * Gets the settings for all instances of the Widget class.
     *
     * @see \WP_Widget::get_settings() :alias:
     *
     * @return mixed[] The multi-dimensional array of widget instance settings.
     */
    public function getSettings()
    {
        /** @var $this \WP_Widget */

        return $this->get_settings();
    }
}
