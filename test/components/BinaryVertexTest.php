<?php declare(strict_types=1);

namespace PGraph\Tests\components;

use PGraph\components\BinaryVertex;
use PHPUnit\Framework\TestCase;

class BinaryVertexTest extends TestCase
{
    public function testGetAndSetLeftVertex()
    {
        $vertex = new BinaryVertex(5);
        $v = new BinaryVertex(2);
        $vertex->setLeftVertex($v);

        $this->assertInstanceOf(BinaryVertex::class, $vertex->getLeftVertex());
        $this->assertEquals($v, $vertex->getLeftVertex());
        $this->assertEquals(2, $vertex->getLeftVertex()->getValue());
    }

    public function testGetAndSetRightVertex()
    {
        $vertex = new BinaryVertex(5);
        $v = new BinaryVertex(2);
        $vertex->setRightVertex($v);

        $this->assertInstanceOf(BinaryVertex::class, $vertex->getRightVertex());
        $this->assertEquals($v, $vertex->getRightVertex());
        $this->assertEquals(2, $vertex->getRightVertex()->getValue());
    }

    /**
     * @depends testGetAndSetLeftVertex
     */
    public function testHasLeftVertex()
    {
        $vertex = new BinaryVertex(2);

        $vertexTow = new BinaryVertex(1);
        $v1 = new BinaryVertex(2);
        $vertexTow->setLeftVertex($v1);

        $this->assertFalse($vertex->hasLeftVertex());
        $this->assertTrue($vertexTow->hasLeftVertex());
    }

    /**
     * @depends testGetAndSetRightVertex
     */
    public function testHasRightVertex()
    {
        $vertex = new BinaryVertex(2);

        $vertexTow = new BinaryVertex(1);
        $v1 = new BinaryVertex(2);
        $vertexTow->setRightVertex($v1);

        $this->assertFalse($vertex->hasRightVertex());
        $this->assertTrue($vertexTow->hasRightVertex());
    }

    public function testGetAndSetValue()
    {
        $vertex = new BinaryVertex();
        $vertexTow = new BinaryVertex(1);
        $vertexThree = new BinaryVertex();
        $vertexThree->setValue(3);

        $this->assertNull($vertex->getValue());
        $this->assertEquals(1, $vertexTow->getValue());
        $this->assertEquals(3, $vertexThree->getValue());
    }

    /**
     * @depends testGetAndSetValue
     */
    public function testGetAndSetParent()
    {
        $parent = new BinaryVertex(2);

        $vertex = new BinaryVertex(1);
        $vertex->setParent($parent);

        $this->assertInstanceOf(BinaryVertex::class, $vertex->getParent());
        $this->assertEquals($parent, $vertex->getParent());
        $this->assertEquals(2, $vertex->getParent()->getValue());
    }
}
