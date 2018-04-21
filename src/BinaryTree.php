<?php declare(strict_types=1);

namespace PGraph;

use Closure;
use PGraph\abstracts\AbstractBinaryTree;
use PGraph\interfaces\BinaryTreeInterface;
use PGraph\interfaces\BinaryVertexInterface;

/**
 * Class BinaryTree
 * @package PGraph
 */
final class BinaryTree extends AbstractBinaryTree implements BinaryTreeInterface
{
    /**
     * @var Closure $searchCompare
     */
    private $searchCompare;

    /**
     * @var BinaryVertexInterface|null $rootVertex
     */
    protected $rootVertex = null;

    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function addVertex(BinaryVertexInterface $newVertex): BinaryVertexInterface
    {
        if (empty($this->rootVertex)) {
            $this->rootVertex = $newVertex;
            return $newVertex;
        }

        return $this->add($newVertex, $this->rootVertex);
    }

    /**
     * @param mixed $value
     * @return BinaryVertexInterface
     */
    public function searchValue($value): ?BinaryVertexInterface
    {
        return $this->isEmpty() ? null : $this->search($value, $this->rootVertex);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function deleteValue($value): ?bool
    {
        if ($this->isEmpty()) {
            return null;
        }

        $vertex = $this->search($value, $this->rootVertex);

        if (empty($vertex)) {
            return null;
        }

        return $this->delete($vertex);
    }

    /**
     * @param Closure $searchCompareFunction
     */
    public function setSearchCompare(Closure $searchCompareFunction): void
    {
        $this->searchCompare = $searchCompareFunction;
    }
    
    /**
     * @param BinaryVertexInterface $newVertex
     * @param BinaryVertexInterface $currentVertex
     * @return BinaryVertexInterface
     */
    private function add(BinaryVertexInterface $newVertex, BinaryVertexInterface $currentVertex)
    {
        $setParent = $this->getSetParentFunction();
        
        if (!$currentVertex->hasLeftVertex()) {
            $setParent->call($newVertex, $currentVertex);
            return $currentVertex->setLeftVertex($newVertex);
        }

        if (!$currentVertex->hasRightVertex()) {
            $setParent->call($newVertex, $currentVertex);
            return $currentVertex->setRightVertex($newVertex);
        }

        if (!$currentVertex->getLeftVertex()->hasLeftVertex() || !$currentVertex->getLeftVertex()->hasRightVertex()) {
            return $this->add($newVertex, $currentVertex->getLeftVertex());
        }

        if ($currentVertex->getRightVertex()->hasLeftVertex() && $currentVertex->getRightVertex()->hasRightVertex()) {
            return $this->add($newVertex, $currentVertex->getLeftVertex());
        }

        return $this->add($newVertex, $currentVertex->getRightVertex());
    }

    /**
     * @param mixed $value
     * @param BinaryVertexInterface $currentVertex
     * @return null|BinaryVertexInterface
     */
    private function search($value, BinaryVertexInterface $currentVertex): ?BinaryVertexInterface
    {
        if (call_user_func_array($this->searchCompare, [$value, $currentVertex])) {
            return $currentVertex;
        }

        if ($currentVertex->hasLeftVertex()) {
            $v = $this->search($value, $currentVertex->getLeftVertex());
            if (!empty($v)) {
                return $v;
            }
        }

        if ($currentVertex->hasRightVertex()) {
            $v = $this->search($value, $currentVertex->getRightVertex());
            if (!empty($v)) {
                return $v;
            }
        }

        return null;
    }
}
