<?php

namespace IrcBotPhp\Core\Event;

use IrcBotPhp\Core\Connection\ConnectionInterface;
use IrcBotPhp\Core\Event\EventInterface;

class SocketConnectionEvent implements EventInterface {

    const CONNECTION_RECEIVED = 'connection.received';
    const CONNECTION_SENT = 'connection.sent';

    /**
     * @var string
     */
    private $message;

    /**
     * @var ConnectionInterface
     */
    private $connection;

    public function __construct($message, ConnectionInterface $connection)
    {
        $this->message = $message;
        $this->connection = $connection;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

}