<?php declare(strict_types=1);

namespace PGraph\interfaces;

use Closure;

/**
 * Interface BinaryTreeInterface
 * @package PGraph\interfaces
 */
interface BinaryTreeInterface
{
    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function addVertex(BinaryVertexInterface $newVertex): BinaryVertexInterface;

    /**
     * @param mixed $value
     * @return null|BinaryVertexInterface
     */
    public function searchValue(mixed $value): ?BinaryVertexInterface;

    /**
     * @param Closure $searchCompareFunction
     */
    public function setSearchCompare(Closure $searchCompareFunction): void;

}
