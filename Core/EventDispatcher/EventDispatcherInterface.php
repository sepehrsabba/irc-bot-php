<?php

namespace IrcBotPhp\Core\EventDispatcher;

interface EventDispatcherInterface {

    public function dispatch($eventName, EventInterface $event);

}