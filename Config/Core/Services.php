<?php

namespace IrcBotPhp\Core\Config;

use IrcBotPhp\Core\Client\Response\IrcResponseFactory;
use IrcBotPhp\Core\Connection\SocketConnection;
use IrcBotPhp\Core\Event\IrcResponseReceivedEvent;
use IrcBotPhp\Core\Event\SocketConnectionEvent;
use IrcBotPhp\Core\EventDispatcher\EventDispatcher;
use IrcBotPhp\Core\Module\EventRaiser\EventRaiser;
use IrcBotPhp\Core\Module\Pharser\Pharser;
use IrcBotPhp\Core\Module\Ping\Ping;

$container['core.event.dispatcher'] = function ($c) {
    return new EventDispatcher($c);
};

$container['core.connection'] = $container->factory(function ($c) {
    return new SocketConnection($c['core.event.dispatcher']);
});

$container['core.response.factory'] = function ($c) {
    return new IrcResponseFactory($c);
};

$container['core.event.raiser'] = function ($c) {
    $eventRaiser = new EventRaiser($c['core.event.dispatcher']);
    $c['core.event.dispatcher']->subscribe(IrcResponseReceivedEvent::IRC_RESPONSE_RECEIVED, 'core.event.raiser', 'onResponseReceived');
    return $eventRaiser;
};

$container['core.pharser'] = function ($c) {
    $pharser = new Pharser($c['core.response.factory'], $c['core.event.dispatcher']);
    $c['core.event.dispatcher']->subscribe(SocketConnectionEvent::CONNECTION_RECEIVED, 'core.pharser', 'onMessageReceived');
    return $pharser;
};

$container['core.ping'] = function ($c) {
    $ping = new Ping();
    $c['core.event.dispatcher']->subscribe(IrcResponseReceivedEvent::IRC_PING_RECEIVED, 'core.ping', 'onPingReceived');
    return $ping;
};