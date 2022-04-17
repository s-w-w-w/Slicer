<?php

include_once(__DIR__ . '/../Slicer.php');
use PHPUnit\Framework\TestCase;

/**
 * @covers Slicer
 */
final class SlicerTest extends TestCase {
  protected function setUp(){
    // setup code here
    $this -> slicer = null;
  }

  // incorrect configuration should fail 
  public function testIncorrectSetup(){
    $this->expectException(InvalidArgumentException::class);
    $this -> slicer = new Slicer([]);
  }

  // test correct correct configuration and available methods
  public function testCorrectSetup(){
    $this -> slicer = new Slicer(['offset' => 0, 'limit' => 1,'items' => ['a','b','c']]);
    $this -> assertEquals(['a'],$this -> slicer -> get());
    $this -> assertTrue($this -> slicer -> hasMore());
    $this -> assertEquals(1,$this -> slicer -> visited());
    $this -> assertEquals(3,$this -> slicer -> countSlices());
    $this -> assertEquals(3,$this -> slicer -> count()); 
  }

  protected function tearDown(){
  }
}     

