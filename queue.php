<?php

class queue {
    private $insertPointer = 0;
    private $removePointer = 0;
    private $size = false;
    private $data = array();

    public function __construct($sizeOfQueue){
        $this->size = $sizeOfQueue;
    }

    public function put($dataInput){
        if($this->size && $this->size <= ($this->insertPointer - $this->removePointer)){
            echo "Queue is full<br />";
        }else {
            $this->data[$this->insertPointer] = $dataInput;
            $this->insertPointer++;
        }
    }

    public function get(){
        if( 0 == ($this->insertPointer - $this->removePointer)){
            echo "Queue is Empty<br />";
        }else {
            $this->removePointer++;
            return $this->data[$this->removePointer-1];
        }
    }

    public function size(){
        return $this->insertPointer - $this->removePointer;
    }
}

$smallQ  = new queue(4);

$smallQ->put(1);
$smallQ->put(2);
$smallQ->put(3);
echo $smallQ->size()."<br />";
$smallQ->put(4);
$smallQ->put(5);
$smallQ->put(6);
echo $smallQ->size()."<br />";
echo $smallQ->get()."<br />";
echo $smallQ->get()."<br />";
echo $smallQ->get()."<br />";
echo $smallQ->size()."<br />";
echo $smallQ->get()."<br />";
echo $smallQ->get();
echo $smallQ->get();
echo $smallQ->get();



?>