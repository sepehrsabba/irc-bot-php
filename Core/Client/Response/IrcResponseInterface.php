<?php

namespace IrcBotPhp\Core\Client\Response;

interface IrcResponseInterface
{
    /**
     * @return string
     */
    public function getRaw();

    /**
     * @return string
     */
    public function getPrefix();

    /**
     * @return string
     */
    public function getCommand();

    /**
     * @return string
     */
    public function getParam();

    /**
     * @return string
     */
    public function getTrail();

}