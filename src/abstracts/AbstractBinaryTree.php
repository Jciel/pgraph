<?php declare(strict_types=1);

namespace PGraph\abstracts;

use Closure;
use PGraph\interfaces\BinaryVertexInterface;

abstract class AbstractBinaryTree
{
    /**
     * @param BinaryVertexInterface|null $vertex
     * @return array|null
     */
    public function inOrder(BinaryVertexInterface $vertex = null): ?array
    {
        static $result = [];

        if (empty($vertex)) {
            $vertex = $this->rootVertex;
        }

        if ($vertex->hasLeftVertex()) {
            $this->inOrder($vertex->getLeftVertex());
        }

        array_push($result, $vertex->getValue());

        if ($vertex->hasRightVertex()) {
            $this->inOrder($vertex->getRightVertex());
        }

        return $result;
    }

    /**
     * @param BinaryVertexInterface|null $vertex
     * @return array|null
     */
    public function preOrder(BinaryVertexInterface $vertex = null): ?array
    {
        static $result = [];

        if (empty($vertex)) {
            $vertex = $this->rootVertex;
        }

        array_push($result, $vertex->getValue());

        if ($vertex->hasLeftVertex()) {
            $this->preOrder($vertex->getLeftVertex());
        }

        if ($vertex->hasRightVertex()) {
            $this->preOrder($vertex->getRightVertex());
        }

        return $result;
    }

    /**
     * @param BinaryVertexInterface|null $vertex
     * @return array|null
     */
    public function postOrder(BinaryVertexInterface $vertex = null): ?array
    {
        static $result = [];

        if (empty($vertex)) {
            $vertex = $this->rootVertex;
        }

        if ($vertex->hasLeftVertex()) {
            $this->postOrder($vertex->getLeftVertex());
        }

        if ($vertex->hasRightVertex()) {
            $this->postOrder($vertex->getRightVertex());
        }

        array_push($result, $vertex->getValue());

        return $result;
    }

    /**
     * @return bool
     */
    protected function isEmpty(): bool
    {
        return empty($this->rootVertex);
    }

    /**
     * @param BinaryVertexInterface $vertex
     * @return bool
     */
    protected function delete(BinaryVertexInterface $vertex): bool
    {
        if (empty($vertex->getLeftVertex()) && empty($vertex->getRightVertex())) {
            $parent = $vertex->getParent();

            if ($parent->getLeftVertex()->getValue() == $vertex->getValue()) {
                $parent->setLeftVertex(null);
                return true;
            }
            $parent->setRightVertex(null);
            return true;
        }

        if (!empty($vertex->getLeftVertex()) && !empty($vertex->getRightVertex())) {
            $min = $this->searchMinimum($vertex->getRightVertex());
            $vertex->setValue($min->getValue());
            $this->delete($min);
            return true;
        }

        if (!empty($vertex->getLeftVertex()) || !empty($vertex->getRightVertex())) {
            $parent = $vertex->getParent();
            $children = $vertex->getLeftVertex() ?? $vertex->getRightVertex();
            if ($parent->getLeftVertex() === $vertex) {
                $parent->setLeftVertex($children);
                return true;
            }
            $parent->setRightVertex($children);
            return true;
        }

        return false;
    }

    /**
     * @param BinaryVertexInterface $currentVertex
     * @return BinaryVertexInterface
     */
    protected function searchMinimum(BinaryVertexInterface $currentVertex): BinaryVertexInterface
    {
        if (!empty($currentVertex->getLeftVertex())) {
            return $this->searchMinimum($currentVertex->getLeftVertex());
        }

        return $currentVertex;
    }

    /**
     * @param BinaryVertexInterface $currentVertex
     * @return BinaryVertexInterface
     */
    protected function searchMaximum(BinaryVertexInterface $currentVertex): BinaryVertexInterface
    {
        if (!empty($currentVertex->getRightVertex())) {
            return $this->searchMaximum($currentVertex->getRightVertex());
        }

        return $currentVertex;
    }

    /**
     * @return Closure
     */
    protected function getSetParentFunction(): Closure
    {
        return function (BinaryVertexInterface $currentVertex) {
            $this->parent = $currentVertex;
        };
    }
}
