<?php

class node {
    var $data;
    var $link_next;

    function __construct($data_entered){
        $this->data = $data_entered;
        $this->link_next = NULL;
    }
}

class link_list {
    public $head = NULL;
    private static $count = 0;

    public static function getCount(){
        return self::$count;
    }

    public function add_node_top($node_data){
        if($this->head == NULL){
            $this->head = new node($node_data);
        }else {
            $temp = new node($node_data);
            $temp->link_next = $this->head;
            $this->head = $temp;
        }
        self::$count++;
    }

    public function add_node_last($node_data){
        if($this->head == NULL){
            $this->head = new node($node_data);
        }else {
            $current = $this->head;
            while($current->link_next != NULL)
                $current = $current->link_next;
            $current->link_next = new node($node_data);
        }
        self::$count++;
    }

    public function display_link(){
        if($this->head == NULL){
            echo "Head->Null";
        }else {
            echo "Head->".$this->head->data."->";
            $current = $this->head;
            while($current->link_next != NULL){
                $current = $current->link_next;
                echo $current->data."->";
            }
            echo "NULL";
        }
    }


}

$N_link = new link_list();
$N_link->add_node_top(2);
$N_link->add_node_last("3");
$N_link->add_node_top(1);
$N_link->add_node_last(4);
$N_link->display_link();
echo "<br /> Size of link-List = ".$N_link->getCount();
?>