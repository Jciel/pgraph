<?php declare(strict_types=1);

namespace PGraph\interfaces;

/**
 * Interface BinaryVertexInterface
 * @package PGraph\interfaces
 */
interface BinaryVertexInterface
{
    /**
     * @param mixed $value
     * @return BinaryVertexInterface
     */
    public function setValue($value): BinaryVertexInterface;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function setLeftVertex(?BinaryVertexInterface $newVertex): ?BinaryVertexInterface;

    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function setRightVertex(?BinaryVertexInterface $newVertex): ?BinaryVertexInterface;

    /**
     * @return null|BinaryVertexInterface
     */
    public function getLeftVertex(): ?BinaryVertexInterface;

    /**
     * @return null|BinaryVertexInterface
     */
    public function getRightVertex(): ?BinaryVertexInterface;

    /**
     * @return null|BinaryVertexInterface
     */
    public function getParent(): ?BinaryVertexInterface;

    /**
     * @param BinaryVertexInterface $newVertex
     */
    public function setParent(BinaryVertexInterface $newVertex);
}
