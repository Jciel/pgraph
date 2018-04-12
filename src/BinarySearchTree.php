<?php declare(strict_types=1);

namespace PGraph;

use Closure;
use PGraph\abstracts\AbstractBinaryTree;
use PGraph\interfaces\BinarySearchTreeInterface;
use PGraph\interfaces\BinaryVertexInterface;

/**
 * Class BinarySearchTree
 * @package PGraph
 */
final class BinarySearchTree extends AbstractBinaryTree implements BinarySearchTreeInterface
{
    /**
     * @var null|BinaryVertexInterface $rootVertex
     */
    protected $rootVertex = null;

    /**
     * @var Closure $addCompare
     */
    private $addCompare;

    /**
     * @var Closure $searchCompare
     */
    private $searchCompare;

    /**
     * @param BinaryVertexInterface $newVertex
     * @return BinaryVertexInterface
     */
    public function addVertex(BinaryVertexInterface $newVertex): BinaryVertexInterface
    {
        if ($this->isEmpty()) {
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
     * @return BinaryVertexInterface
     */
    public function searchMin(): BinaryVertexInterface
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->searchMinimum($this->rootVertex);
    }

    /**
     * @return BinaryVertexInterface
     */
    public function searchMax(): BinaryVertexInterface
    {
        return $this->isEmpty() ? null : $this->searchMaximum($this->rootVertex);
    }

    /**
     * @param Closure $addCompareFunction
     */
    public function setAddCompare(Closure $addCompareFunction): void
    {
        $this->addCompare = $addCompareFunction;
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
    private function add(BinaryVertexInterface $newVertex, BinaryVertexInterface $currentVertex): BinaryVertexInterface
    {
        $isSmaller = call_user_func_array($this->addCompare, [$newVertex, $currentVertex]);

        if ($isSmaller && empty($currentVertex->getLeftVertex())) {
            $newVertex->setParent($currentVertex);
            return $currentVertex->setLeftVertex($newVertex);
        }

        if (!$isSmaller && empty($currentVertex->getRightVertex())) {
            $newVertex->setParent($currentVertex);
            return $currentVertex->setRightVertex($newVertex);
        }

        if ($isSmaller) {
            return $this->add($newVertex, $currentVertex->getLeftVertex());
        } else {
            return $this->add($newVertex, $currentVertex->getRightVertex());
        }
    }

    /**
     * @param mixed $value
     * @param BinaryVertexInterface $currentVertex
     * @return BinaryVertexInterface
     */
    private function search($value, BinaryVertexInterface $currentVertex): ?BinaryVertexInterface
    {
        $result = call_user_func_array($this->searchCompare, [$value, $currentVertex]);

        if ($result == 0) {
            return $currentVertex;
        } elseif ($result == -1 && !empty($currentVertex->getLeftVertex())) {
            return $this->search($value, $currentVertex->getLeftVertex());
        } elseif ($result == 1 && !empty($currentVertex->getRightVertex())) {
            return $this->search($value, $currentVertex->getRightVertex());
        }

        return null;
    }
}
