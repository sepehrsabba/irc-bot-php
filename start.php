<?php

    namespace IrcBotPhp;

    include 'vendor/autoload.php';

    use \IrcBotPhp\Core\Client\IrcClient;
    use \IrcBotPhp\Core\Connection\ConnectionInterface;
    use \IrcBotPhp\Core\Client\IrcWorker;
    use \Pimple\Container;

    $container = new Container();

    include 'Config/Core/Services.php';

    $enabledModules = [
        /** load core modules */
        'core.pharser',
        'core.event.raiser',
        'core.ping'

        /** load optional modules */
    ];

    foreach($enabledModules as $module) {
        $container[$module];
    }

    /** @var ConnectionInterface $connection */
    $connection = $container['core.connection'];
    $connection->connect('irc.quakenet.org',6667);

    $ircClient = new IrcClient($connection);
    $ircClient->pass('NOPASS');
    $ircClient->user('sepehr','codeon','codeon','sepehr sabbagh');
    $ircClient->nick('[S]Bot');

    $ircWorker = new IrcWorker($connection);
    $ircWorker->startReceiving();