<?php

namespace App\Tests\Service;

use App\Entity\LinkedList;
use App\Entity\Node;
use App\Service\LinkedListService;
use App\Service\NodeFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LinkedListServiceTest extends KernelTestCase
{
    public function testAddingNewHead(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var LinkedListService */
        $linkedListService = $container->get(LinkedListService::class);

        $linkedListService->setLinkedList(new LinkedList())->addNode(NodeFactory::createWithIntegerValue(2));
        $head = $linkedListService->getLinkedList()->getHead();

        $this->assertInstanceOf(Node::class, $head);
    }

    public function testAddingAndSortedThreeNodes(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var LinkedListService */
        $linkedListService = $container->get(LinkedListService::class);

        $linkedListService->setLinkedList(new LinkedList());
        $linkedListService->addNode(NodeFactory::createWithIntegerValue(2));
        $linkedListService->addNode(NodeFactory::createWithIntegerValue(3));
        $linkedListService->addNode(NodeFactory::createWithIntegerValue(1));

        $this->assertEquals(1, $linkedListService->getFirstNode()->getValue());
        $this->assertEquals(3, $linkedListService->getLastNode()->getValue());
    }

    public function testRemovingNode(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var LinkedListService */
        $linkedListService = $container->get(LinkedListService::class);

        $node5 = NodeFactory::createWithIntegerValue(5);
        $node3 = NodeFactory::createWithIntegerValue(3);
        $node1 = NodeFactory::createWithIntegerValue(1);

        $linkedListService->setLinkedList(new LinkedList());
        $linkedListService->addNode($node3);
        $linkedListService->addNode($node1);
        $linkedListService->addNode($node5);

        $linkedListService->removeNode($node5);

        $this->assertEquals(1, $linkedListService->getFirstNode()->getValue());
        $this->assertEquals(3, $linkedListService->getLastNode()->getValue());

        $linkedListService->removeNode($node3);

        $this->assertEquals($node1, $linkedListService->getFirstNode());
        $this->assertEquals($node1, $linkedListService->getFirstNode());

        $linkedListService->removeNode($node1);

        $this->assertNull($linkedListService->getFirstNode());
        $this->assertNull($linkedListService->getLastNode());
    }

    public function testFindingNodeByValue(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var LinkedListService */
        $linkedListService = $container->get(LinkedListService::class);

        $node5 = NodeFactory::createWithIntegerValue(5);
        $node3 = NodeFactory::createWithIntegerValue(3);
        $node1 = NodeFactory::createWithIntegerValue(1);

        $linkedListService->setLinkedList(new LinkedList());
        $linkedListService->addNode($node3);
        $linkedListService->addNode($node1);
        $linkedListService->addNode($node5);

        $this->assertNull($linkedListService->findNodeByValue(2));
        $this->assertEquals($node3, $linkedListService->findNodeByValue(3));
    }


    public function testAddingAndSortedThreeNodesStringValue(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var LinkedListService */
        $linkedListService = $container->get(LinkedListService::class);

        $linkedListService->setLinkedList(new LinkedList());
        $linkedListService->addNode(NodeFactory::createWithStringValue('abc'));
        $linkedListService->addNode(NodeFactory::createWithStringValue('aab'));
        $linkedListService->addNode(NodeFactory::createWithStringValue('acd'));

        $this->assertEquals('aab', $linkedListService->getFirstNode()->getValue());
        $this->assertEquals('acd', $linkedListService->getLastNode()->getValue());
    }
}
