<?php

namespace IrcBotPhp\Core\Connection;

use IrcBotPhp\Core\Connection\Exception\ConnectionException;
use IrcBotPhp\Core\Connection\Exception\ConnectionReceiveException;
use IrcBotPhp\Core\Connection\Exception\ConnectionSendException;
use IrcBotPhp\Core\Event\SocketConnectionEvent;
use IrcBotPhp\Core\EventDispatcher\EventDispatcher;

class SocketConnection implements ConnectionInterface
{
    private $socket;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param $host
     * @param $port
     * @throws ConnectionException
     */
    public function connect($host, $port)
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, 0);

        if ($this->socket === false) {
            throw new ConnectionException('Connecting to server failed with error: ' . socket_last_error($this->socket) . ' - ' . socket_strerror($this->socket));
        }

        $result = socket_connect($this->socket, $host, $port);

        if ($result === false) {
            throw new ConnectionException('Connecting to server failed with error: ' . socket_last_error($this->socket) . ' - ' . socket_strerror($this->socket));
        }
    }

    /**
     * @param $message
     * @throws ConnectionSendException
     */
    public function send($message)
    {
        $message .= "\r\n";

        $result = socket_write($this->socket, $message, strlen($message));

        if($result === false) {
            throw new ConnectionSendException('Connecting to server failed with error: ' . socket_last_error($this->socket) . ' - ' . socket_strerror($this->socket));
        }

        $this->eventDispatcher->dispatch(SocketConnectionEvent::CONNECTION_SENT, new SocketConnectionEvent($message,$this));

        echo "<<< $message";
    }

    /**
     * @return string
     * @throws ConnectionReceiveException
     */
    public function receive()
    {
        $result = socket_read($this->socket, 1024);

        if($result === false) {
            throw new ConnectionReceiveException('Failed to send message: ' . socket_last_error($this->socket) . ' - ' . socket_strerror($this->socket));
        }

        $this->eventDispatcher->dispatch(SocketConnectionEvent::CONNECTION_RECEIVED, new SocketConnectionEvent($result,$this));

        echo ">>> $result";

        return $result;
    }

    /**
     * return void
     */
    public function close()
    {
        socket_close($this->socket);
    }

}