<?php
/**
 * Control Aware Widget Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Widget;

/**
 * Interface ControlAwareWidgetInterface
 *
 * @package Devaloka\Component\Widget
 *
 * @codeCoverageIgnore
 */
interface ControlAwareWidgetInterface extends WidgetInterface
{
    /**
     * Gets the Widget control options.
     *
     * @return mixed[] The control options.
     */
    public function getControlOptions();

    /**
     * Renders a Widget settings form.
     *
     * @param mixed[] $instance The instance-specific Widget settings.
     *
     * @return string The rendered HTML.
     */
    public function renderForm(array $instance);

    /**
     * Displays a Widget settings form.
     *
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function displayForm(array $instance);

    /**
     * Updates a Widget settings.
     *
     * @param mixed[] $newInstance The new settings.
     * @param mixed[] $oldInstance The old settings.
     *
     * @return mixed[]|bool The settings to save or false to cancel saving.
     */
    public function update(array $newInstance, array $oldInstance);
}
