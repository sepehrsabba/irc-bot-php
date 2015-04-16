<?php

namespace IrcBotPhp\Core\Module\Pharser;

use IrcBotPhp\Core\Client\IrcClient;
use IrcBotPhp\Core\Client\Response\IrcResponseFactoryInterface;
use IrcBotPhp\Core\Event\IrcResponseReceivedEvent;
use IrcBotPhp\Core\Event\SocketConnectionEvent;
use IrcBotPhp\Core\EventDispatcher\EventDispatcher;

class Pharser  {

    /**
     * @var IrcResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    function __construct(IrcResponseFactoryInterface $responseFactory, EventDispatcher $eventDispatcher)
    {
        $this->responseFactory = $responseFactory;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function onMessageReceived(SocketConnectionEvent $socketConnectionEvent)
    {
        $messages = explode("\n",$socketConnectionEvent->getMessage());

        foreach($messages as $message) {
            $regex = '((:(?<prefix>\S+) )?(?<command>\S+)( (?!:)(?<params>.+?))?( :(?<trail>.+))?)';
            $pharsed = preg_match($regex, $message, $matches);

            if (!$pharsed) {
                continue;
            }

            //Create the response
            $response = $this->responseFactory->createNewResponse($matches[0], $matches['prefix'], $matches['command'], $matches['params'], $matches['trail']);


            $this->eventDispatcher->dispatch(IrcResponseReceivedEvent::IRC_RESPONSE_RECEIVED, new IrcResponseReceivedEvent($response, new IrcClient($socketConnectionEvent->getConnection())));
        }
    }

}