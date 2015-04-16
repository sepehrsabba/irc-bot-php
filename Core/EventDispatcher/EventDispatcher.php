<?php

namespace IrcBotPhp\Core\EventDispatcher;

use Pimple\Container;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var EventSubscriberInterface[]
     */
    private $subscribers;

    /**
     * @var Container
     */
    private $container;

    function __construct(Container $container)
    {
        $this->container = $container;
        $this->subscribers = [];
    }

    public function subscribe($eventName,$service,$method)
    {
        if(!isset($this->subscribers[$eventName][$service]) || !in_array($method,$this->subscribers[$eventName][$service])) {
            $this->subscribers[$eventName][$service] = $method;
        }
    }

    public function dispatch($eventName, EventInterface $event = null)
    {

        if (!isset($this->subscribers[$eventName])) return;

        foreach ($this->subscribers[$eventName] as $service => $method) {
            $this->container[$service]->$method($event);
        }

    }

}