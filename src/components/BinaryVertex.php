<?php declare(strict_types=1);

namespace PGraph\components;

use PGraph\interfaces\BinaryVertexInterface;

/**
 * Class BinaryVertex
 * @package PGraph\components
 */
final class BinaryVertex implements BinaryVertexInterface
{
    /**
     * @var BinaryVertexInterface|null $leftVertex
     */
    private $leftVertex = null;

    /**
     * @var BinaryVertexInterface|null $rightVertex
     */
    private $rightVertex = null;

    /**
     * @var BinaryVertexInterface|null $parent
     */
    private $parent = null;

    /**
     * @var mixed|null $value
     */
    private $value = null;

    /**
     * BinaryVertex constructor.
     * @param null|mixed $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function hasLeftVertex(): bool
    {
        return (!empty($this->leftVertex)) ? true : false;
    }

    /**
     * @return bool
     */
    public function hasRightVertex(): bool
    {
        return (!empty($this->rightVertex)) ? true : false;
    }

    /**
     * @param mixed $value
     * @return BinaryVertexInterface
     */
    public function setValue($value): BinaryVertexInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function setLeftVertex(?BinaryVertexInterface $newVertex): ?BinaryVertexInterface
    {
        $this->leftVertex = $newVertex;
        return $newVertex;
    }

    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function setRightVertex(?BinaryVertexInterface $newVertex): ?BinaryVertexInterface
    {
        $this->rightVertex = $newVertex;
        return $newVertex;
    }

    /**
     * @return mixed $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return null|BinaryVertexInterface
     */
    public function getLeftVertex(): ?BinaryVertexInterface
    {
        return $this->leftVertex;
    }

    /**
     * @return null|BinaryVertexInterface
     */
    public function getRightVertex(): ?BinaryVertexInterface
    {
        return $this->rightVertex;
    }
    
    /**
     * @return null|BinaryVertexInterface
     */
    public function getParent(): ?BinaryVertexInterface
    {
        return $this->parent;
    }
}
