<?php

namespace IrcBotPhp\Core\Client;


use IrcBotPhp\Core\Connection\ConnectionFactoryInterface;
use IrcBotPhp\Core\Connection\ConnectionInterface;

class IrcClient implements IrcClientInterface
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function user($username, $hostname, $serverName, $realName)
    {
        //ToDo: add validation
        $this->connection->send('USER '.$username.' '.$hostname.' '.$serverName.' :'.$realName);
    }

    public function nick($nick)
    {
        //ToDo: add validation
        $this->connection->send('NICK '.$nick);
    }

    public function pass($pass)
    {
        //ToDo: add validation
        $this->connection->send('NICK '.$pass);
    }

    public function pong($daemon)
    {
        //ToDo: add validation
        $this->connection->send('PONG :'.$daemon);
    }
}