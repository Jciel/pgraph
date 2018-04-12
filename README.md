# PGraph


Library to work with Binary Search Tree (BST) and Binary Tree (BT) data structure in PHP.
It is possible to work with scalar values and objects.

## Quickstart examples

# Binary Tree

### Working with scalar values and Binary Tree

That Tree trying always create a complete tree from the left to right

#### Instantiate and define search compare function
We first instantiate a BT,for the search we must define
the 'search function', this allows the user to define
what he is working with.  
As we are working with scalar values the function is similar to this, 
this function should return true or false.  
The $value variable is the value to be found.  
The $currentVertex variable is the current vertex/node in the search process

```php
<?php

    $bt = new BinaryTree();

    $searchCompareTree = function ($value, $currentVertex) {
        return $value == $currentVertex->getValue();
    };
    
    $bt->setSearchCompare($searchCompareTree);
    
```

#### Operations
  
##### Add vertex

Instantiate a new vertex passing the value by parameter,
then pass the vertex to the ``addVertex`` method of the created binary tree.  
The first vertex passed will be the root of the tree.  
Follows the same process to add new vertices.

```php
<?php

    $nv1 = new BinaryVertex(5);
    $nv2 = new BinaryVertex(2);
    $nv3 = new BinaryVertex(3);
    $nv4 = new BinaryVertex(4);
    
    $bt->addVertex($nv1);
    $bt->addVertex($nv2);
    $bt->addVertex($nv3);
    $bt->addVertex($nv4);
```

##### Search a value

To search for a value we use the ``searchValue`` method of the binary
tree passing the value to be found.  
This method returns a ``BinaryVertex`` and we can use the ``getValue``
method to retrieve the value.  
This method uses the ``searchCompareTree`` function previously defined
to find the requested value.

```php
<?php

    $vertex = $bt->searchValue(4);
    
    $value = $vertex->getValue(); // $value = 4
```
  
##### Delete a value

To delete a value we use the method ``deleteValue`` passing the value
to be deleted.  
This method return true if it succeeded in deleting or false otherwise

```php
<?php
    
    $bt->deleteValue(4); // return true
    $bt->deleteValue(20); // return false   
```

#### Tree traversal

###### In-order
In-order tree traversal visit the left vertex first, then the root
vertex, and after the right vertex.  
We achieved this using the ``inOrder`` method of the binary tree.  
This method returns a array containing the values in that order.

```php
<?php
    
    $inOrder = $bt->inOrder(); // $inOrder = [4, 2, 5, 3]
          
```

###### Pre-order
In pre-order traversal the root vertex is visisted first, after the
left and then the right vertex.  
Using the method ``preOrder`` we have an array containing the values
in that order.

```php
<?php
    
    $preOrder = $bt->preOrder(); // $preOrder = [5, 2, 4, 3]
          
```

###### Post-order
In this traversal method, the root vertex is visited last, first visited
the left vertex and then the right vertex.  
Using the method ``postOrder`` we have an array containing the values
in the post-order.

```php
<?php
    
    $postOrder = $bt->postOrder(); // $postOrder = [4, 2, 3, 5]
          
```

### Working with objects and Binary Tree

Imagining a class ``Person`` with the following code:  

```php
<?php
    class Person
    {
        private age;
        
        public function __contructor($age)
        {
            $this->age = $age;
        }
        
        public function getAge()
        {
            return $this->age;
        }
    }
          
```

and we want to save object of this class in a binary tree comparing it
by propertie age.  
To add we do not need to change anything.

```php
<?php

    $bt = new BinaryTree();

    $person1 = new Person(20);
    $person2 = new Person(26);
    $person3 = new Person(18);
    $person4 = new Person(13);
    
    $bt->addVertex($person1);
    $bt->addVertex($person2);
    $bt->addVertex($person3);
    $bt->addVertex($person4);
```

But for us to search and delete values comparing age, we must alter
and set the comparison function of the search.

```php
<?php

    $searchCompareTree = function ($value, $currentVertex) {
        $person = $currentVertex->getValue(); // This method return a value, in this case it is a Person
        return $value == $person->getAge();
    };
    
    $bt->setSearchCompare($searchCompareTree);
```

Now we can execute the search and delete methods by passint an age value.

```php
<?php

    $vertex = $bt->searchValue(26);
    $person = $vertex->getValue(); // This returns a Person
    $age = $person->getAge(); // It returns the age of that person
    
    $bt->deleteValue(13); // return true
```


# Binary Search Tree

A Binary Search Tree that is built in such way that the tree is
always sorte. This means the left child vertex has a value less
than or equal to the parent vertex value, and right child vertex
will have the value greater than the parent vertex value.

### Working with scalar values and Binary Search Tree

We first instantiate a BST,for the search we must define
the 'search function' and for add we must define the 'add function'.  
The 'add function' should return __true__ if the new value is
less than or equal and __false__ if that value is greater.
The 'search function' should return -1 if the value passed by parameter
is less than the value of the current vertex, 0 if both values are equal
and 1 if this value is greater than the value of current vertex

```php
<?php

    $bst = new BinarySearchTree();
    
    $addCompare = function ($newVertex, $currentVertex) {
        return ($newVertex->getValue() <= $currentVertex->getValue()) ? true : false;
    };

    $searchCompare = function ($val, $currentVertex) {
        return $val <=> $currentVertex->getValue();
    };
    
    $bst->setAddCompare($addCompare);
    $bst->setSearchCompare($searchCompare);
```


#### Operations
  
##### Add vertex

To add new vertex.
```php
<?php

    $nv1 = new BinaryVertex(5);
    $nv2 = new BinaryVertex(7);
    $nv3 = new BinaryVertex(4);
    $nv4 = new BinaryVertex(2);
    $nv5 = new BinaryVertex(8);
    $nv6 = new BinaryVertex(6);
    
    $bst->addVertex($nv1);
    $bst->addVertex($nv2);
    $bst->addVertex($nv3);
    $bst->addVertex($nv4);
    $bst->addVertex($nv5);
    $bst->addVertex($nv6);
```


##### Search a value

To search for a value we use the ``searchValue`` method of the binary
search tree passing the value to be found.  
This method returns a ``BinaryVertex`` and we can use the ``getValue``
method to retrieve the value.  
This method uses the ``searchCompare`` function previously defined
to find the requested value.

```php
<?php

    $vertex = $bst->searchValue(4);
    
    $value = $vertex->getValue(); // $value = 4
```

##### Delete a value

To delete a value we use the method ``deleteValue`` passing the value
to be deleted.  
This method return true if it succeeded in deleting or false otherwise

```php
<?php
    
    $bst->deleteValue(4); // return true
    $bst->deleteValue(20); // return false   
```


##### Finding minimum and maximum
As binary search tree store data in a sorted order, we can always
find the smaller data in the left vertex, ande the bigger in the
 right vertex, this return a BinariVertex.

```php
<?php
    
    $min = $bst->searchMin();
    $max = $bst->searchMax();
    
    $valueMin = $min->getValue(); // $min = 2
    $valueMax = $max->getValue(); // $max = 8
    
```

#### Binary Search Tree traversal

###### In-order
In-order tree traversal visit the left vertex first, then the root
vertex, and after the right vertex.  
We achieved this using the ``inOrder`` method of the binary tree.  
This method returns a array containing the values in that order.

```php
<?php
    
    $inOrder = $bst->inOrder(); // $inOrder = [2, 4, 5, 6, 7, 8]
          
```

###### Pre-order
In pre-order traversal the root vertex is visisted first, after the
left and then the right vertex.  
Using the method ``preOrder`` we have an array containing the values
in that order.

```php
<?php
    
    $preOrder = $bst->preOrder(); // $preOrder = [5, 4, 2, 7, 6, 8]
          
```

###### Post-order
In this traversal method, the root vertex is visited last, first visited
the left vertex and then the right vertex.  
Using the method ``postOrder`` we have an array containing the values
in the post-order.

```php
<?php
    
    $postOrder = $bst->postOrder(); // $postOrder = [2, 4, 6, 8, 7, 5]
          
```

### Working with objects and Binary Search Tree

Imagining a class ``Person`` with the following code:  

```php
<?php
    class Person
    {
        private age;
        
        public function __contructor($age)
        {
            $this->age = $age;
        }
        
        public function getAge()
        {
            return $this->age;
        }
    }
          
```


For us to search, add and delete values comparing age, we must alter
and set the comparison function and add function.

```php
<?php

    $bst = new BinarySearchTree();

    $addCompare = function ($newVertex, $currentVertex) {
        $person1 = $newVertex->getValue();
        $person2 = $currentVertex->getValue();
        return ($person1->getAge() <= $person2->getAge()) ? true : false;
    };

    $searchCompare = function ($val, $currentVertex) {
        $person = $currentVertex->getValue();
        return $val <=> $person->getAge();
    };
    
    $bst->setAddCompare($addCompare);
    $bst->setSearchCompare($searchCompare);
```

Now we can add vertex contend objects in tree.

```php
<?php

    $bst = new BinarySearchTree();

    $person1 = new Person(20);
    $person2 = new Person(26);
    $person3 = new Person(18);
    $person4 = new Person(13);
    
    $bst->addVertex($person1);
    $bst->addVertex($person2);
    $bst->addVertex($person3);
    $bst->addVertex($person4);
```

Search and delete comparing property age.

```php
<?php

    $vertex = $bst->searchValue(26);
    $person = $vertex->getValue(); // This returns a Person
    $age = $person->getAge(); // It returns the age of that person
    
    $bst->deleteValue(13); // return true
```
