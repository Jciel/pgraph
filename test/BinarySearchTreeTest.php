<?php declare(strict_types=1);

namespace PGraph\Tests;

use PGraph\BinarySearchTree;
use PGraph\components\BinaryVertex;

class BinarySearchTreeTest extends AbstractTestCase
{
    protected $bst;
    protected $btsEmpty;

    protected function setUp()
    {
        $addCompare = function ($newVertex, $currentVertex) {
            return ($newVertex->getValue() <= $currentVertex->getValue()) ? true : false;
        };

        $searchCompare = function ($val, $currentVertex) {
            return $val <=> $currentVertex->getValue();
        };

        $this->bst = new BinarySearchTree();

        $this->bst->setAddCompare($addCompare);
        $this->bst->setSearchCompare($searchCompare);

        $this->btsEmpty = new BinarySearchTree();
    }

    public function testIsEmpty()
    {
        $this->addVertex();

        $notEmpty = $this->invokeMethod($this->bst, 'isEmpty');
        $empty = $this->invokeMethod($this->btsEmpty, 'isEmpty');

        $this->assertFalse($notEmpty);
        $this->assertTrue($empty);
    }

    public function testAdd()
    {
        $currentVertex = new BinaryVertex(5);
        $newVertex = new BinaryVertex(3);

        $nv = $this->invokeMethod($this->bst, 'add', array($newVertex, $currentVertex));

        $this->assertInstanceOf(BinaryVertex::class, $nv);
        $this->assertEquals(3, $nv->getValue());
    }

    /**
     * @depends testAdd
     */
    public function testAddVertex()
    {
        $v1 = new BinaryVertex(5);
        $v2 = new BinaryVertex(7);
        $v3 = new BinaryVertex(6);
        $v4 = new BinaryVertex(4);
        $v5 = new BinaryVertex(2);
        $v6 = new BinaryVertex(3);
        $v7 = new BinaryVertex(1);
        $v8 = new BinaryVertex(8);

        $rv1 = $this->bst->addVertex($v1);
        $rv2 = $this->bst->addVertex($v2);
        $rv3 = $this->bst->addVertex($v3);
        $rv4 = $this->bst->addVertex($v4);
        $rv5 = $this->bst->addVertex($v5);
        $rv6 = $this->bst->addVertex($v6);
        $rv7 = $this->bst->addVertex($v7);
        $rv8 = $this->bst->addVertex($v8);

        $this->assertInstanceOf(BinaryVertex::class, $rv1);
        $this->assertInstanceOf(BinaryVertex::class, $rv2);
        $this->assertInstanceOf(BinaryVertex::class, $rv3);
        $this->assertInstanceOf(BinaryVertex::class, $rv4);
        $this->assertInstanceOf(BinaryVertex::class, $rv5);
        $this->assertInstanceOf(BinaryVertex::class, $rv6);
        $this->assertInstanceOf(BinaryVertex::class, $rv7);
        $this->assertInstanceOf(BinaryVertex::class, $rv8);
        $this->assertEquals(5, $rv1->getValue());
        $this->assertEquals(7, $rv2->getValue());
        $this->assertEquals(6, $rv3->getValue());
        $this->assertEquals(4, $rv4->getValue());
        $this->assertEquals(2, $rv5->getValue());
        $this->assertEquals(3, $rv6->getValue());
        $this->assertEquals(1, $rv7->getValue());
        $this->assertEquals(8, $rv8->getValue());
    }

    /**
     * @depends testAddVertex
     * @depends testAdd
     */
    public function testSearch()
    {
        $this->addVertex();

        $reflection = new \ReflectionClass(get_class($this->bst));
        $property = $reflection->getProperty("rootVertex");
        $property->setAccessible(true);

        $rootVertex = $property->getValue($this->bst);

        $found = $this->invokeMethod($this->bst, 'search', [4, $rootVertex]);
        $notFound = $this->invokeMethod($this->bst, 'search', [20, $rootVertex]);

        $this->assertInstanceOf(BinaryVertex::class, $found);
        $this->assertEquals(4, $found->getValue());
        $this->assertNull($notFound);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     * @depends testSearch
     */
    public function testSearchValue()
    {
        $this->addVertex();

        $found = $this->bst->searchValue(4);
        $notFound = $this->bst->searchValue(20);

        $this->assertInstanceOf(BinaryVertex::class, $found);
        $this->assertEquals(4, $found->getValue());

        $this->assertNull($notFound);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     * @depends testSearchValue
     */
    public function testDelete()
    {
        $this->addVertex();

        $v1 = $this->bst->searchValue('1');
        $v4 = $this->bst->searchValue('4');
        $v7 = $this->bst->searchValue('7');

        $deletedLeaf = $this->invokeMethod($this->bst, 'delete', [$v1]);
        $deletedOneChild = $this->invokeMethod($this->bst, 'delete', [$v4]);
        $deletedTwoChild = $this->invokeMethod($this->bst, 'delete', [$v7]);

        $this->assertTrue($deletedLeaf);
        $this->assertTrue($deletedOneChild);
        $this->assertTrue($deletedTwoChild);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     * @depends testSearchValue
     * @depends testDelete
     */
    public function testDeleteValue()
    {
        $this->addVertex();

        $result = $this->bst->deleteValue(2);
        $notFound = $this->bst->deleteValue(20);

        $this->assertTrue($result);
        $this->assertNull($notFound);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     * @depends testSearchValue
     * @depends testDelete
     */
    public function testSearchMinimum()
    {
        $this->addVertex();

        $v4 = $this->bst->searchValue('4');
        $v7 = $this->bst->searchValue('7');

        $min1 = $this->invokeMethod($this->bst, 'searchMinimum', [$v4]);
        $min6 = $this->invokeMethod($this->bst, 'searchMinimum', [$v7]);

        $this->assertInstanceOf(BinaryVertex::class, $min1);
        $this->assertInstanceOf(BinaryVertex::class, $min6);

        $this->assertEquals(1, $min1->getValue());
        $this->assertEquals(6, $min6->getValue());
    }

    public function testSearchMaximum()
    {
        $this->addVertex();

        $v4 = $this->bst->searchValue('4');
        $v7 = $this->bst->searchValue('7');

        $max4 = $this->invokeMethod($this->bst, 'searchMaximum', [$v4]);
        $max8 = $this->invokeMethod($this->bst, 'searchMaximum', [$v7]);

        $this->assertInstanceOf(BinaryVertex::class, $max4);
        $this->assertInstanceOf(BinaryVertex::class, $max8);

        $this->assertEquals(4, $max4->getValue());
        $this->assertEquals(8, $max8->getValue());
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testSearchMin()
    {
        $this->addVertex();

        $min = $this->bst->searchMin();

        $this->assertInstanceOf(BinaryVertex::class, $min);
        $this->assertEquals(1, $min->getValue());
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testSearchMax()
    {
        $this->addVertex();

        $max = $this->bst->searchMax();

        $this->assertInstanceOf(BinaryVertex::class, $max);
        $this->assertEquals(8, $max->getValue());
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testInOrder()
    {
        $this->addVertex();

        $inOrder = $this->bst->inOrder();

        $this->assertCount(8, $inOrder);
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8], $inOrder);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testPreOrder()
    {
        $this->addVertex();

        $preOrder = $this->bst->preOrder();

        $this->assertCount(8, $preOrder);
        $this->assertEquals([5, 4, 2, 1, 3, 7, 6, 8], $preOrder);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testPostOrder()
    {
        $this->addVertex();

        $postOrder = $this->bst->postOrder();

        $this->assertCount(8, $postOrder);
        $this->assertEquals([1, 3, 2, 4, 6, 8, 7, 5], $postOrder);
    }

    private function addVertex()
    {
        $v1 = new BinaryVertex(5);
        $v2 = new BinaryVertex(7);
        $v3 = new BinaryVertex(6);
        $v4 = new BinaryVertex(4);
        $v5 = new BinaryVertex(2);
        $v6 = new BinaryVertex(3);
        $v7 = new BinaryVertex(1);
        $v8 = new BinaryVertex(8);

        $this->bst->addVertex($v1);
        $this->bst->addVertex($v2);
        $this->bst->addVertex($v3);
        $this->bst->addVertex($v4);
        $this->bst->addVertex($v5);
        $this->bst->addVertex($v6);
        $this->bst->addVertex($v7);
        $this->bst->addVertex($v8);
    }
}
