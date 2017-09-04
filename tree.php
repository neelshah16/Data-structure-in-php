<?php

class tree {
    public $leftChild;
    public $RightChild;
    public $root;

    function __construct($data){
        $this->root = $data;
    }

    public function insert($data){
        if($data <= $this->root){
            if($this->leftChild == null){
                $this->leftChild = new tree($data);
            }else {
                $this->leftChild->insert($data);
            }
        }else {
            if($this->RightChild == null){
                $this->RightChild = new tree($data);
            }else {
                $this->RightChild->insert($data);
            }
        }
    }

    public function contains($data){
        if($data == $this->root){
            return true;
        }elseif($data <= $this->root){
            if($this->leftChild == null){
                return false;
            }else {
                return $this->leftChild->contains($data);
            }
        }else {
            if($this->RightChild == null){
                return false;
            }else {
                return $this->RightChild->contains($data);
            }
        }
    }

    public function in_order_traversal(){
        if($this->leftChild != null){
            $this->leftChild->in_order_traversal();
        }
        echo $this->root."<br />";
        if($this->RightChild != null){
            $this->RightChild->in_order_traversal();
        }
    }

    public function pre_order_traversal(){
        echo $this->root."<br />";

        if($this->leftChild != null){
            $this->leftChild->pre_order_traversal();
        }

        if($this->RightChild != null){
            $this->RightChild->pre_order_traversal();
        }
    }

    public function post_order_traversal(){
        if($this->leftChild != null){
            $this->leftChild->post_order_traversal();
        }

        if($this->RightChild != null){
            $this->RightChild->post_order_traversal();
        }

        echo $this->root."<br />";
    }

    public function balance_constant(){
        if($this->leftChild == null && $this->RightChild == null){
            return 0;
        }elseif($this->leftChild != null && $this->RightChild == null){
            return ($this->leftChild->balance_constant()+1);
        }elseif($this->leftChild == null && $this->RightChild != null){
            return ($this->RightChild->balance_constant()+1);
        }else {
            return ($this->RightChild->balance_constant() + $this->leftChild->balance_constant());
        }
    }

//    public function balanceTree(){
//        $r = $this->RightChild->balance_constant();
//        $l = $this->leftChild->balance_constant();
//        if($r > $l && $r - $l >= 2){
//
//        }elseif($l > $r && $l - $r >= 2){
//
//        }
//    }

}

$tree = new tree(8);
$tree->insert(4);
$tree->insert(2);
$tree->insert(3);
$tree->insert(5);
$tree->insert(6);
$tree->insert(7);
$tree->insert(9);
$tree->insert(10);
$tree->insert(11);
$tree->insert(12);
$tree->insert(13);
$tree->insert(14);
$tree->insert(15);

$tree->in_order_traversal();
echo $tree->balance_constant();



?>