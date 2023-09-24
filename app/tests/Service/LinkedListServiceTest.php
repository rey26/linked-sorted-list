<?php

namespace App\Tests\Service;

use App\Entity\LinkedList;
use App\Entity\Node;
use App\Service\LinkedListService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LinkedListServiceTest extends KernelTestCase
{
    public function testAddingNewHead(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var LinkedListService */
        $linkedListService = $container->get(LinkedListService::class);

        $linkedListService->setLinkedList(new LinkedList())->addNode((new Node())->setIntValue(1));
        $head = $linkedListService->getLinkedList()->getHead();

        $this->assertInstanceOf(Node::class, $head);
    }
}
