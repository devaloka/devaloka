<?php
/**
 * Templating Listener
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Templating\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Devaloka\Component\EventDispatcher\EventDispatcherAwareInterface;
use Devaloka\Component\EventDispatcher\EventDispatcherAwareTrait;
use Devaloka\Component\Templating\TemplatingInterface;
use Devaloka\Component\Templating\InjectableTemplatingInterface;

/**
 * Class TemplatingListener
 *
 * @package Devaloka\Component\Templating\EventListener
 */
class TemplatingListener implements EventSubscriberInterface, EventDispatcherAwareInterface
{
    use EventDispatcherAwareTrait;

    /**
     * @var TemplatingInterface
     */
    protected $templating;

    /**
     * @param TemplatingInterface $templating
     */
    public function __construct(TemplatingInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'template_redirect' => ['onTemplateRedirect', ~PHP_INT_MAX],
        ];
    }

    public function onTemplateRedirect()
    {
        if ($this->templating instanceof InjectableTemplatingInterface) {
            $this->templating->injectGlobals();
        }
    }
}
