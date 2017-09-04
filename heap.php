<?php

class Heap {
    public $dataArray = [];
    public $dataSize = 1;

    public function getLeftChildIndex($parentIndex){ return $parentIndex*2;}
    public function getRightChildIndex($parentIndex){ return $parentIndex*2+1;}
    public function getParentIndex($child){ return floor($child/2);}

    public function getLeftChildValue($parentIndex){
        if(isset($this->dataArray[$parentIndex*2])) return $this->dataArray[$parentIndex*2];
        else false;
    }

    public function getRightChildValue($parentIndex){
        if(isset($this->dataArray[$parentIndex*2+1])) return $this->dataArray[$parentIndex*2+1];
        else false;
    }

    public function getParentValue($child){
        if(floor($child/2) < 1) return false;
        else return $this->dataArray[floor($child/2)];
    }


    private function swapIndex($a,$b){
        $temp = $this->dataArray[$a];
        $this->dataArray[$a] = $this->dataArray[$b];
        $this->dataArray[$b] = $temp;
    }

    public function insert($value){
        $this->dataArray[$this->dataSize] = $value;
        $CurrentIndex = $this->dataSize;
        while($this->getParentValue($CurrentIndex)){
            if($this->getParentValue($CurrentIndex) > $value){
                $this->swapIndex($CurrentIndex,$this->getParentIndex($CurrentIndex));
            }else {
                break;
            }
            $CurrentIndex = $this->getParentIndex($CurrentIndex);
        }
        $this->dataSize++;
        print_r($this->dataArray);
        echo "<br />";
    }

    public function delete($value){
        $index = array_search($value, $this->dataArray);
        if(!$index){
            echo $value." No element Found<br />";
        }else {
            $this->dataSize--;
            $this->swapIndex($index, $this->dataSize);// swap with last
            unset($this->dataArray[$this->dataSize]);// Remove last
            while($this->getLeftChildValue($index)){
                if($this->dataArray[$index] <= $this->getLeftChildValue($index)){
                    if($this->getRightChildValue($index) && $this->getRightChildValue($index) < $this->dataArray[$index]){
                        $this->swapIndex($index, $this->getRightChildIndex($index));
                        $index = $this->getRightChildIndex($index);
                    }else {
                        break;
                    }
                } else {
                    $this->swapIndex($index, $this->getLeftChildIndex($index));
                    $index = $this->getLeftChildIndex($index);
                }
            }
            print_r($this->dataArray);
            echo "<br />";
        }
    }
}

$heap = new Heap();
$heap->insert(5);
$heap->insert(2);
$heap->insert(3);
$heap->insert(4);
$heap->insert(11);
$heap->insert(6);
$heap->insert(7);
$heap->insert(8);
$heap->insert(9);
$heap->insert(10);


echo "<br /><br /><br />";

$heap->delete(3);
$heap->delete(5);
$heap->delete(2);
$heap->delete(6);
$heap->delete(11);
$heap->delete(4);
$heap->delete(8);
$heap->delete(7);
$heap->delete(10);
$heap->delete(9);


?>