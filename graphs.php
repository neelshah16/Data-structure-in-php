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

class graph {
    public $vertices = [];
    public $edges = [];

    function __construct($vertices){
        if(is_array($vertices)){
            $this->vertices = $vertices;
        } else {
            array_push($this->vertices,$vertices);
        }
    }

    public function addVertices($vertice){
        array_push($this->vertices,$vertice);
    }

    public function addEdges($to,$from){
        $this->edges[$from][$to] = $to;
        $this->edges[$to][$from] = $from;
    }

    public function edgeExist($m,$n){
        if($this->edges[$m][$n] == 1 || $this->edges[$n][$m] == 1) return true;
        else return false;
    }



    public function searchDFS($start, $search){
        $visited = [];
        array_push($visited,$start);
        $stack = new stack(100);
        $stack->push($start);
        $found = false;
        $current = $start;

        while(!$found){
            $allDone = 0;
            echo "<br />".$current." Checking <br />";
            foreach($this->edges[$current] as $i){
                echo $i." ------";
                $oktoGo = 1;
                foreach($visited as $k) if($k == $i){
                    $oktoGo = 0;
                    break;
                }

                if($oktoGo){
                    array_push($visited,$i);
                    $stack->push($i);
                    $current = $i;
                    echo " Entering to <br />";
                    $allDone = 1;
                    break;
                } else {
                    $allDone = 0;
                    echo " Already Visited <br />";
                }
            }

            if($stack->getPointer() <= 0){
                echo "not Found <br />";
            }

            if(!$allDone){
                $current =  $stack->pop();
                echo $current." -- Back to <br />";
            }

            if($search == $current) {
                echo "<br />".$search." Found <br />";
                $found = 1;
            }

        }
    }

    public function searchBFS($start, $search){
        $visited = [];
        array_push($visited,$start);
        $queue = new queue(100);
        $found = false;
        $current = $start;

        while(!$found){
            $allDone = 0;
            echo "<br />".$current." Checking <br />";
            foreach($this->edges[$current] as $i){
                echo $i." ------";
                $oktoGo = 1;
                foreach($visited as $k) if($k == $i){
                    $oktoGo = 0;
                    break;
                }

                if($oktoGo){
                    array_push($visited,$i);
                    $queue->put($i);
                    echo " Mark Visited<br />";
                } else {
                    $allDone = 0;
                    echo " Already Visited <br />";
                }

                if($search == $i) {
                    echo "<br />".$search." Found <br />";
                    $found = 1;
                    break;
                }
            }

            if(!$allDone && !$found){
                $current =  $queue->get();
                echo $current." -- going Forward <br />";
            }

        }
    }

}

$Graphs = new graph(['S','A','B','C','D','E']);
$Graphs->addEdges('S','A');
$Graphs->addEdges('S','B');
$Graphs->addEdges('S','C');
$Graphs->addEdges('A','D');
$Graphs->addEdges('B','D');
$Graphs->addEdges('C','D');

echo print_r($Graphs->edges)."<br />";

$Graphs->searchBFS('S', 'D');

?>