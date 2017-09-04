<?php

class stack {
    private $max_size = null;
    private $pointer = 0;
    private $data = array();

    public function getPointer(){
        return $this->pointer;
    }

    function __construct($max_size){
        $this->max_size = $max_size;
    }

    public function push($new_data){
        if($this->max_size != null && $this->pointer > $this->max_size){
            exit('Stack Over Flow');
        }else {
            $this->data[$this->pointer] = $new_data;
            $this->pointer++;
        }
    }

    public function pop(){
        if($this->pointer == 0)
            exit('Stack Under Flow');
        else
            $this->pointer--;
    }

    public function peek(){
        if($this->pointer > 0)
             return $this->data[$this->pointer-1];
        else return "Stack Empty";
    }

}

$small3 = new stack(3);

$small3->push('1');
echo $small3->peek();
$small3->push('2');
echo $small3->peek();
$small3->push('3');
echo $small3->peek();
$small3->push('4');
echo $small3->peek();

$small3->pop();
echo $small3->peek();
$small3->pop();
echo $small3->peek();
$small3->pop();
echo $small3->peek();



?>