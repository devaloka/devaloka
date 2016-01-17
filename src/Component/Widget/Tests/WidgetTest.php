<?php
namespace Devaloka\Component\Widget\Tests;

use Brain\Monkey;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class WidgetTest
 *
 * @package Tests\Devaloka\Component\Widget
 * @author Whizark <devaloka@whizark.com>
 */
class WidgetTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up a test.
     */
    protected function setUp()
    {
        Monkey::setUpWP();
    }

    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Monkey::tearDownWP();
    }

    public function aliasPropertyDataProvider()
    {
        return [
            'idBase'         => ['idBase', 'id_base',],
            'widgetOptions'  => ['widgetOptions', 'widget_options'],
            'controlOptions' => ['controlOptions', 'controlOptions'],
            'isUpdated'      => ['isUpdated', 'updated'],
            'optionName'     => ['optionName', 'option_name'],
            'altOptionName'  => ['altOptionName', 'altOptionName'],
        ];
    }

    /**
     * @dataProvider aliasPropertyDataProvider
     *
     * @param string $aliasPropery
     * @param string $originalProperty
     */
    public function testAliasPropertyShouldSetValueToOriginalProperty($aliasProperty, $originalProperty)
    {
        $wpWidget = $this->createWpWidget();
        $widget   = $this->createWidget();

        $widget->{$aliasProperty} = 'test value';

        $this->assertSame('test value', $widget->{$originalProperty});
    }

    /**
     * @dataProvider aliasPropertyDataProvider
     *
     * @param string $aliasPropery
     * @param string $originalProperty
     */
    public function testAliasPropertyShouldReturnValueFromOriginalProperty($aliasProperty, $originalProperty)
    {
        $wpWidget = $this->createWpWidget();
        $widget   = $this->createWidget();

        $widget->{$originalProperty} = 'test value';

        $this->assertSame('test value', $widget->{$aliasProperty});
    }

    public function testUnknownPropertyShouldBehaveAsNormalProperty()
    {
        $wpWidget = $this->createWpWidget();
        $widget   = $this->createWidget();

        $widget->unknown = 'test value';

        $this->assertSame('test value', $widget->unknown);
    }

    public function testGetNameShouldReturnPropertyValue()
    {
        $wpWidget = $this->createWpWidget();
        $widget   = $this->createWidget();

        $widget->name = 'Test Widget';

        $this->assertSame('Test Widget', $widget->getName());
    }

    public function testGetOptionsShouldReturnPropertyValue()
    {
        $wpWidget = $this->createWpWidget();
        $widget   = $this->createWidget();

        $widget->widget_options = ['classname' => 'test-widget'];

        $this->assertSame(['classname' => 'test-widget'], $widget->getOptions());
    }

    public function testRenderShouldInvokeWpWidgetWidget()
    {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive('widget')
            ->with(['before_title' => '<span>', 'after_title' => '</span>'], ['title' => 'Test Widget'])
            ->once();

        $widget = $this->createWidget();

        $widget->render(['before_title' => '<span>', 'after_title' => '</span>'], ['title' => 'Test Widget']);
    }

    public function testDisplayShouldInvokeWpWidgetWidget()
    {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive('widget')
            ->with(['before_title' => '<span>', 'after_title' => '</span>'], ['title' => 'Test Widget'])
            ->once();

        $widget = $this->createWidget();

        $widget->display(['before_title' => '<span>', 'after_title' => '</span>'], ['title' => 'Test Widget']);
    }

    public function aliasMethodDataProvider()
    {
        return [
            'getFieldName()'    => [
                'getFieldName',
                'get_field_name',
                'with',
                'name',
                'andReturn',
                'field-name',
            ],
            'getFieldId()'      => [
                'getFieldId',
                'get_field_id',
                'with',
                'name',
                'andReturn',
                'field-id',
            ],
            'isPreview()'       => [
                'isPreview',
                'is_preview',
                'withNoArgs',
                null,
                'andReturn',
                false,
            ],
            'displayCallback()' => [
                'displayCallback',
                'display_callback',
                'withArgs',
                [
                    ['before_title' => '<span>', 'after_title' => '</span>'],
                    1,
                ],
                'andReturnUndefined',
                null,
            ],
            'updateCallback()'  => [
                'updateCallback',
                'update_callback',
                'with',
                1,
                'andReturnUndefined',
                null,
            ],
            'formCallback()'    => [
                'formCallback',
                'form_callback',
                'with',
                1,
                'andReturn',
                '<form></form>',
            ],
            'saveSettings()'    => [
                'saveSettings',
                'save_settings',
                'with',
                ['title' => 'Test Widget'],
                'andReturnUndefined',
                null,
            ],
            'getSettings()'     => [
                'getSettings',
                'get_settings',
                'withNoArgs',
                null,
                'andReturn',
                ['title' => 'Test Widget'],
            ],
        ];
    }

    /**
     * @dataProvider aliasMethodDataProvider
     *
     * @param string $aliasMethod
     * @param string $originalMethod
     * @param string $with
     * @param mixed|null $args
     * @param string $return
     * @param mixed|null $returnValue
     */
    public function testAliasMethodShouldInvokeWpWidgetMethod(
        $aliasMethod,
        $originalMethod,
        $with,
        $args,
        $return,
        $returnValue
    ) {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive($originalMethod)
            ->{$with}(
                $args
            )
            ->{$return}(
                $returnValue
            )
            ->once();

        $widget = $this->createWidget($args);

        if ($with === 'withArgs') {
            $result = call_user_func_array([$widget, $aliasMethod], $args);
        } else {
            $result = $widget->{$aliasMethod}($args);
        }

        if ($return !== 'andReturnUndefined') {
            $this->assertSame($returnValue, $result);
        }
    }

    // Methods for the tests.

    protected function createWpWidget()
    {
        return Mockery::mock('overload:WP_Widget');
    }

    protected function createWidget()
    {
        return new TestWidget();
    }
}
