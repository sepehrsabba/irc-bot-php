<?php

namespace IrcBotPhp\Core\Client;

Interface IrcClientInterface
{

    public function user($username, $hostname, $serverName, $realName);

    public function nick($nick);

    public function pass($pass);

}