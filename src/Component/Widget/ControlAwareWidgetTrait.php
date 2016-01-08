<?php
/**
 * Control Aware Widget Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Widget;

/**
 * Class ControlAwareWidgetTrait
 *
 * @package Devaloka\Component\Widget
 *
 * @codeCoverageIgnore
 */
trait ControlAwareWidgetTrait
{
    use WidgetTrait;

    /**
     * Gets the Widget control options.
     *
     * @return mixed[] The control options.
     */
    public function getControlOptions()
    {
        /** @var \WP_Widget $this */

        return $this->control_options;
    }

    /**
     * Renders a Widget settings form.
     *
     * @param mixed[] $instance The instance-specific Widget settings.
     *
     * @return string The rendered HTML.
     */
    public function renderForm(array $instance)
    {
        ob_start();

        parent::form($instance);

        return ob_get_clean();
    }

    /**
     * Displays a Widget settings form.
     *
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function displayForm(array $instance)
    {
        echo $this->renderForm($instance);
    }

    /**
     * Displays a Widget settings form.
     *
     * @see ControlAwareWidgetTrait::displayForm() :alias:
     *
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function form(array $instance)
    {
        $this->displayForm($instance);
    }

    /**
     * Updates a Widget settings.
     *
     * @param mixed[] $newInstance The new settings.
     * @param mixed[] $oldInstance The old settings.
     *
     * @return mixed[]|bool The settings to save or false to cancel saving.
     */
    public function update($newInstance, $oldInstance)
    {
        return parent::update($newInstance, $oldInstance);
    }
}
