<?php

namespace IrcBotPhp\Core\Client\Response;

class IrcResponseFactory implements IrcResponseFactoryInterface {

    /**
     * @param $raw
     * @param $prefix
     * @param $command
     * @param $param
     * @param $trail
     * @return IrcResponseInterface
     */
    public function createNewResponse($raw, $prefix, $command, $param, $trail)
    {
        return new IrcResponse($raw,$prefix,$command,$param,$trail);
    }
}