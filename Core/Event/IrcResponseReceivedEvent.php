<?php

namespace IrcBotPhp\Core\Event;

use IrcBotPhp\Core\Client\IrcClient;
use IrcBotPhp\Core\Client\Response\IrcResponse;
use IrcBotPhp\Core\Event\EventInterface;

class IrcResponseReceivedEvent implements EventInterface {

    const IRC_RESPONSE_RECEIVED = 'irc.received';
    const IRC_PING_RECEIVED = 'irc.ping.received';
    const IRC_PRIVMSG_RECIEVED = 'irc.privmsg.received';

    /**
     * @var IrcResponse
     */
    private $ircResponse;

    /**
     * @var IrcClient;
     */
    private $ircClient;

    public function __construct(IrcResponse $ircResponse, IrcClient $ircClient)
    {
        $this->ircResponse = $ircResponse;
        $this->ircClient = $ircClient;
    }

    /**
     * @return IrcResponse
     */
    public function getResponse()
    {
        return $this->ircResponse;
    }

    /**
     * @return IrcClient
     */
    public function getClient()
    {
        return $this->ircClient;
    }

}