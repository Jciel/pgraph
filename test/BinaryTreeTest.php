<?php declare(strict_types=1);

namespace PGraph\Tests;

use PGraph\BinaryTree;
use PGraph\components\BinaryVertex;

class BinaryTreeTest extends AbstractTestCase
{
    protected $bt;

    protected function setUp()
    {
        $searchCompareTree = function ($val, $currentVertex) {
            return $val == $currentVertex->getValue();
        };

        $this->bt = new BinaryTree();
        $this->bt->setSearchCompare($searchCompareTree);
    }

    public function testAdd()
    {
        $currentVertex = new BinaryVertex(5);
        $newVertex = new BinaryVertex(3);

        $nv = $this->invokeMethod($this->bt, 'add', array($newVertex, $currentVertex));

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

        $rv1 = $this->bt->addVertex($v1);
        $rv2 = $this->bt->addVertex($v2);
        $rv3 = $this->bt->addVertex($v3);
        $rv4 = $this->bt->addVertex($v4);
        $rv5 = $this->bt->addVertex($v5);
        $rv6 = $this->bt->addVertex($v6);
        $rv7 = $this->bt->addVertex($v7);
        $rv8 = $this->bt->addVertex($v8);

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

        $rootVertex = $this->getPropertyValue($this->bt, 'rootVertex');

        $found = $this->invokeMethod($this->bt, 'search', [4, $rootVertex]);
        $notFound = $this->invokeMethod($this->bt, 'search', [20, $rootVertex]);

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

        $found = $this->bt->searchValue(4);
        $notFound = $this->bt->searchValue(20);

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

        $v1 = $this->bt->searchValue('1');
        $v4 = $this->bt->searchValue('4');
        $v7 = $this->bt->searchValue('7');

        $deletedLeaf = $this->invokeMethod($this->bt, 'delete', [$v1]);
        $deletedOneChild = $this->invokeMethod($this->bt, 'delete', [$v4]);
        $deletedTwoChild = $this->invokeMethod($this->bt, 'delete', [$v7]);

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

        $result = $this->bt->deleteValue(2);
        $notFound = $this->bt->deleteValue(20);

        $this->assertTrue($result);
        $this->assertNull($notFound);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testInOrder()
    {
        $this->addVertex();

        $inOrder = $this->bt->inOrder();

        $this->assertCount(8, $inOrder);
        $this->assertEquals([8, 4, 7, 2, 5, 3, 6, 1], $inOrder);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testPreOrder()
    {
        $this->addVertex();

        $preOrder = $this->bt->preOrder();

        $this->assertCount(8, $preOrder);
        $this->assertEquals([5, 7, 4, 8, 2, 6, 3, 1], $preOrder);
    }

    /**
     * @depends testAdd
     * @depends testAddVertex
     */
    public function testPostOrder()
    {
        $this->addVertex();

        $postOrder = $this->bt->postOrder();

        $this->assertCount(8, $postOrder);
        $this->assertEquals([8, 4, 2, 7, 3, 1, 6, 5], $postOrder);
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

        $this->bt->addVertex($v1);
        $this->bt->addVertex($v2);
        $this->bt->addVertex($v3);
        $this->bt->addVertex($v4);
        $this->bt->addVertex($v5);
        $this->bt->addVertex($v6);
        $this->bt->addVertex($v7);
        $this->bt->addVertex($v8);
    }
}
