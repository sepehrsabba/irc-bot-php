<?php

namespace IrcBotPhp\Core\Module\Ping;

use IrcBotPhp\Core\Event\IrcResponseReceivedEvent;

class Ping {

    public function onPingReceived(IrcResponseReceivedEvent $ircResponseReceivedEvent)
    {
        $ircResponseReceivedEvent->getClient()->pong($ircResponseReceivedEvent->getResponse()->getTrail());
    }

}