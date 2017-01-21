<?php
namespace Devaloka\Component\MetaBox\Tests;

use Devaloka\Component\MetaBox\AbstractMetaBox;
use WP_Post;

/**
 * Class TestMetaBox
 *
 * @package Devaloka\Component\MetaBox\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class TestMetaBox extends AbstractMetaBox
{
    /**
     * {@inheritDoc}
     */
    public function render(WP_Post $post)
    {
        return 'Test Meta Box Content';
    }
}
