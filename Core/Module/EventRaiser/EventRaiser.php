<?php

namespace IrcBotPhp\Core\Module\EventRaiser;

use IrcBotPhp\Core\Event\IrcResponseReceivedEvent;
use IrcBotPhp\Core\EventDispatcher\EventDispatcher;

class EventRaiser  {

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function onResponseReceived(IrcResponseReceivedEvent $ircResponseReceivedEvent)
    {
        $response = $ircResponseReceivedEvent->getResponse();

        switch($response->getCommand())
        {
            case 'PING':
                    $this->eventDispatcher->dispatch(IrcResponseReceivedEvent::IRC_PING_RECEIVED, $ircResponseReceivedEvent);
                break;

            case 'PRIVMSG':
                $this->eventDispatcher->dispatch(IrcResponseReceivedEvent::IRC_PRIVMSG_RECIEVED, $ircResponseReceivedEvent);
                break;
        }

    }

}