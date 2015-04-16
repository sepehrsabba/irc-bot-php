<?php

namespace IrcBotPhp\Core\Connection;

use IrcBotPhp\Core\Connection\Exception\ConnectionException;
use IrcBotPhp\Core\Connection\Exception\ConnectionReceiveException;
use IrcBotPhp\Core\Connection\Exception\ConnectionSendException;

interface ConnectionInterface {

    /**
     * used to initialize a connection to a server on the give host and port.
     *
     * @param $host
     * @param $port
     * @throws ConnectionException
     */
    public function connect($host,$port);

    /**
     * send a message to the server.
     *
     * @param $message
     * @return void
     * @throws ConnectionSendException
     */
    public function send($message);

    /**
     * retrieve a message from the server
     *
     * @return string
     * @throws ConnectionReceiveException
     */
    public function receive();

    /**
     * close the current connection
     *
     * @return void
     */
    public function close();

}