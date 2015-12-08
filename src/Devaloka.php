<?php
/**
 * Devaloka
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka;

use Devaloka\DependencyInjection\ContainerInterface;
use Devaloka\DependencyInjection\ContainerAwareTrait;
use Devaloka\DependencyInjection\ContainerAwareInterface;
use Devaloka\Provider\ServiceProviderInterface;
use Devaloka\Provider\BootableProviderInterface;
use Devaloka\Provider\EventListenerProviderInterface;

/**
 * Class Devaloka
 *
 * @package Devaloka
 */
class Devaloka implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var Provider\ServiceProviderInterface[]
     */
    protected $providers = [];

    /**
     * @var bool
     */
    protected $booted = false;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function register(ServiceProviderInterface $provider, array $values = [])
    {
        $this->providers[] = $provider;

        $provider->register($this, $this->container);

        foreach ($values as $key => $value) {
            $this->container->add($key, $value);
        }

        return $this;
    }

    public function boot()
    {
        if ($this->booted) {
            return;
        }

        foreach ($this->providers as $provider) {
            if ($provider instanceof EventListenerProviderInterface) {
                $provider->subscribe($this, $this->container, $this->container->get('event_dispatcher'));
            }

            if ($provider instanceof BootableProviderInterface) {
                $provider->boot($this, $this->container);
            }
        }

        $this->booted = true;
    }

    public function getContainer()
    {
        return $this->container;
    }
}
