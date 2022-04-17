<?php
/* 
  Slicer - PHP Library 
    - get a portion of an array of length given by a limit, starting at an offset 

  API:
    Instance methods:
      get() - get a slice
      hasMore() - check if there are more slices after the current one
      visited() - get number of slices before the current slice
      countSlices() - get number of all available slices
      count() - get number of items in items;

  Configuration:
    $config = [
       offset - int - 0 or a greater number 
       limit - int - 1 or a greater number
       items - array - array of items to partion into smaller group of arrays
    ];
  Usage:       
    $slicer = new Slicer(['offset' => 0, 'limit' => 1,'items' => ['a','b','c']]);
    $slice = $slicer -> get(); 
*/

class Slicer{

    // prep exception messages
    const INVALID_OFFSET = 'Slicer: Offset must not be less than 0';
    const INVALID_LIMIT = 'Slicer: Limit must be greater than 0;';
    const INVALID_ITEMS = 'Slicer: No items given in configuration;';

    // defaults
    protected $offset = 0;
    protected $limit = 2;
    protected $items = [];

    // internals
    private $beginSlice = 0;
    private $endSlice = 0;
    private $slice = [];


    public function __construct($config = []) {
      
      $this -> prepare($config); 
      // validate configuration before beginning to process
      $this -> validate(); 

      $this -> beginSlice = $this -> offset * $this -> limit;
      $this -> endSlice = $this -> offset * $this -> limit + $this -> limit; 
    } 

    private function prepare($config){
      if(isset($config['items']) and is_array($config['items'])){
        $this -> items = $config['items'];
      }

      if( isset($config['limit']) ){
          $this -> limit = (int)$config['limit'];
      }

      if(isset($config['offset'])){
          $this -> offset = (int)$config['offset'];
      }
    }

    // offset must be a 0 or grater
    private function validate(){
      if($this -> offset < 0){
        throw new InvalidArgumentException(self::INVALID_OFFSET);
      }

      // if limit is less than 1 then nothing can be selected
      if($this -> limit < 1){
        throw new InvalidArgumentException(self::INVALID_LIMIT);
      }

      if(count($this -> items) < 1){
        throw new InvalidArgumentException(self::INVALID_ITEMS);
      }
    }

    // get slice
    public function get(){
      for($i = $this -> beginSlice; $i < $this -> endSlice; $i++ ){
        if(isset($this -> items[$i])){
          $this -> slice[] = $this -> items[$i];  
        }  
      }
      return $this -> slice;
    }

    // can a new slice be constructed  
    public function hasMore(){        
      if( isset ( $this -> items[ $this -> endSlice] ) ){
        return true;
      } else {
        return false;
      }
    }

    // number of visited items counting from the first to the item endSlice points to:
    public function visited(){
      if($this -> hasMore()){
        return $this -> endSlice;
      } else {
        return $this -> count(); 
      }
    }

    // count slices in the collection
    public function countSlices(){
      return (int)ceil(count($this -> items) / $this -> limit);  
    }

    // count items in the collection
    public function count(){
      return count($this -> items);
    }
}
?>
