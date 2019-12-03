<?php
declare(strict_types=1);

namespace Application\Handler;

use Application\Command\CreateVisitor;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\Visitor;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateVisitorHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(CreateVisitor $command)
    {
        $this->em->persist(Visitor::fromCommand($command));
    }
}