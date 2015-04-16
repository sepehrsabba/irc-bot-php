<?php

namespace IrcBotPhp\Core\Client\Response;

class IrcResponse implements IrcResponseInterface {

    /**
     * @var string
     */
    private $raw;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $command;

    /**
     * @var string
     */
    private $param;

    /**
     * @var string
     */
    private $trail;

    function __construct($raw="", $prefix="", $command="", $param="", $trail="")
    {
        $this->raw = $raw;
        $this->prefix = $prefix;
        $this->command = $command;
        $this->param = $param;
        $this->trail = $trail;
    }

    public function getRaw()
    {
        return $this->raw;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getTrail()
    {
        return $this->trail;
    }
}