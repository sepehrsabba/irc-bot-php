<?php

namespace IrcBotPhp\Core\Client\Response;

interface IrcResponseFactoryInterface {

    /**
     * @param $raw
     * @param $prefix
     * @param $command
     * @param $param
     * @param $trail
     * @return IrcResponseInterface
     */
    public function createNewResponse($raw, $prefix, $command, $param, $trail);

}