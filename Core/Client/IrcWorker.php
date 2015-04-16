<?php

namespace IrcBotPhp\Core\Client;

use IrcBotPhp\Core\Connection\ConnectionInterface;

class IrcWorker implements IrcWorkerInterface
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var bool
     */
    private $continue;

    function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
        $this->continue = true;
    }

    public function startReceiving()
    {
        while($this->continue) {
            $this->connection->receive();
        }
    }

    public function stopReceiving()
    {
        $this->continue = false;
    }

    public function run()
    {
        $this->startReceiving();
    }

}