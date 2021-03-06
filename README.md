# Slicer

  Slicer - PHP Library 
    - get a portion of an array of length given by a limit, starting at an offset

## Description
  Slicer is a PHP library to assist you with obtaining a chunk of an array of items. 
  You tell it what array to work on, where in the array to start looking for items, and how many items
  you want to get, and it will return the part of the array you want. Please, see the Usage section for examples.

## Installation
  Copy Slicer.php file in a folder where PHP can find it. You might need to add namespace in the library file

## Configuration

### Configuration options
Slicer can be configured using an associative arra of parameters (optional parameters are given in square brackets): 

**items** - array - array of items to work to work on. Any type of item is valid, 

**[offset]** - int - >= 0 - specifies the first array item to return in a slice,

**[limit]** - int - >= 1 - specifies number of items to return in a slice.
  

```php
$config = [
  'offset' => 0, 
  'limit' => 1,
  'items' => ['a','b','c']
];
```

## Usage
Usage examples:

```php

//get instance
$slicer = new Slicer(['offset' => 0, 'limit' => 1,'items' => ['a','b','c']]);

// get required slice
$slicer -> get(); => ['a']

// check if another slice is available
$slicer -> hasMore(); => True

// get number of slices counting from the beginning of the item array, current slice included 
$slicer -> visited(); => 1

// get number of available slice based on the given slice item count (provided as $limit)
$this -> slicer -> countSlices(); => 3

// get number of items in the item array
$slicer -> count()); => 3

```

