<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class MessageGenerator
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    // public function getHappyMessage(): string
    // {
    //     $this->logger->info('About to find a happy message!');
    // }
}

?>