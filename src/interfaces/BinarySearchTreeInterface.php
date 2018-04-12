<?php declare(strict_types=1);

namespace PGraph\interfaces;

use Closure;

/**
 * Interface BinarySearchTreeInterface
 * @package PGraph\interfaces
 */
interface BinarySearchTreeInterface
{
    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function addVertex(BinaryVertexInterface $newVertex): BinaryVertexInterface;

    /**
     * @param Closure $addCompareFunction
     */
    public function setAddCompare(Closure $addCompareFunction): void;

    /**
     * @param Closure $searchCompareFunction
     */
    public function setSearchCompare(Closure $searchCompareFunction): void;

    /**
     * @param mixed $value
     * @return BinaryVertexInterface
     */
    public function searchValue(mixed $value): ?BinaryVertexInterface;

    /**
     * @return BinaryVertexInterface
     */
    public function searchMin(): BinaryVertexInterface;

    /**
     * @return BinaryVertexInterface
     */
    public function searchMax(): BinaryVertexInterface;

    /**
     * @param mixed $value
     * @return bool
     */
    public function deleteValue(mixed $value): ?bool;
}
